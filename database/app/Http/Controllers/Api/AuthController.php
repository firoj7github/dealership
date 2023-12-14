<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EmailVerificationRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\SignInRequest;
use App\Http\Requests\Api\SignUpRequest;
use App\Http\Requests\Api\SocialLoginRequest;
use App\Http\Services\UserService;
use App\Models\MobileDevice;
use App\Models\PasswordReset;
use App\Models\Subscriber;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signUp(SignUpRequest $request)
    {
        $service = new UserService();
        $response = $service->signUp($request);

        return response()->json($response);
    }

    public function signIn(SignInRequest $request)
    {
        $service = new UserService();
        $response = $service->signIn($request);

        return response()->json($response);
    }

    public function resendEmailVerificationCode()
    {
        $user = Auth::user();
        if ($user->status == USER_ACTIVE_STATUS) {
            return response()->json([
                'success' => false,
                'message' => __('Your account is already verified'),
                'data' => null
            ]);
        }
        $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
        $randNo = randomNumber(6);
        try {
            $defaultEmail = empty($subscriber->customer) ? 'noreply@apperoni.org' : $subscriber->customer->user->email;
            $defaultName = empty($subscriber->customer) ? 'Apperoni' : $subscriber->customer->company_name;
            $logo =  empty($subscriber->logo) ? asset('assets/images/logo.png') : asset(logoViewPath() . $subscriber->logo);
            Mail::send('email.email_verification', ['key' => $randNo, 'company' => $defaultName, 'logo' => $logo], function ($message) use ($user, $defaultEmail, $defaultName) {
                $message->to($user->email)->subject(__('Email Verification'))->from(
                    $defaultEmail, $defaultName
                );
            });
            $user->email_verification_code = $randNo;
            $user->update();
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => __('Something went wrong. Please try again') . $exception->getMessage(),
                'data' => null
            ]);
        }

        $response = [
            'success' => true,
            'message' => __("Code has been sent to your email"),
            'data' => null
        ];

        return response()->json($response);
    }

    public function emailVerify(EmailVerificationRequest $request)
    {
        $user = Auth::user();
        if ($user->status == USER_ACTIVE_STATUS) {
            return response()->json([
                'success' => false,
                'message' => __("Your account is already verified"),
                'data' => null
            ]);
        }

        if ($user->email_verification_code == $request->email_verification_code) {
            DB::beginTransaction();
            try {
                $user->email_verification_code = null;
                $user->status = USER_ACTIVE_STATUS;
                $user->update();
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => __("Something went wrong. Please try again") . $exception->getMessage(),
                    'data' => null
                ]);
            }

            $response = [
                'success' => true,
                'message' => __("Account is verified successfully."),
                'data' => null
            ];
        } else {
            $response = [
                'success' => false,
                'message' => __("Account verification code is invalid."),
                'data' => null
            ];
        }

        return response()->json($response);
    }

    public function getSubscriberDetails(Request $request)
    {
        $validator = Validator::make($request->all(), ['user_name' => 'required'], ['user_name.required' => __('User name can not be empty')]);

        if ($validator->fails()) {
            $errors = "";
            $e = $validator->errors()->all();
            foreach ($e as $error) {
                $errors .= $error . "\n";
            }
            $response = [
                'success' => false,
                'message' => $errors,
                'data' => null
            ];

            return response()->json($response);
        }

        $user = User::with('customer')->where(['user_name' => $request->user_name, 'status' => ACTIVE_STATUS, 'role' => ADMIN_ROLE])->first();
        if (empty($user)) {
            return response()->json([
                'success' => false,
                'message' => __('User not found'),
                'data' => null
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'subscriber_id' => $user->customer->subscriber->id,
//                'logo' => asset(logoViewPath() . $user->customer->subscriber->logo),
//                'image' => asset(imageViewPath() . $user->customer->subscriber->image),
//                'color_1' => $user->customer->subscriber->color_1,
//                'color_2' => $user->customer->subscriber->color_2,
            ],
            'message' => ''
        ]);
    }

    public function sendForgetPasswordEmail(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email' => 'required',
                'subscriber_id' => 'required|exists:subscribers,id',
            ],
            [
                'email.required' => __('Email can not be empty'),
                'subscriber_id.required' => __('Subscriber field can not be empty'),
                'subscriber_id.exists' => __('Invalid subscriber'),
            ]);

        if ($validator->fails()) {
            $errors = "";
            $e = $validator->errors()->all();
            foreach ($e as $error) {
                $errors .= $error . "\n";
            }
            $response = [
                'success' => false,
                'message' => $errors,
                'data' => null
            ];

            return response()->json($response);
        }

        $user = User::where(['email' => $request->email, 'subscriber_id' => $request->subscriber_id])->where('is_social_login', '!=', 1)->first();
        if (empty($user)) {
            return response()->json([
                'success' => false,
                'message' =>  __('User not found'),
                'data' => null
            ]);
        }
        $subscriber = Subscriber::with('customer')->where('id', $user->subscriber_id)->first();
        $randNo = randomNumber(6);
        try {
            $defaultEmail = empty($subscriber->customer) ? 'noreply@apperoni.org' : $subscriber->customer->user->email;
            $defaultName = empty($subscriber->customer) ? 'Apperoni' : $subscriber->customer->company_name;
            $logo =  empty($subscriber->logo) ? asset('assets/images/logo.png') : asset(logoViewPath() . $subscriber->logo);
            Mail::send('email.forget_password', ['key' => $randNo, 'company' => $defaultName, 'logo' => $logo], function ($message) use ($user, $defaultEmail, $defaultName) {
                $message->to($user->email)->subject(__('Forget Password'))->from(
                    $defaultEmail, $defaultName
                );
            });
            PasswordReset::create([
                'user_id' => $user->id,
                'verification_code' => $randNo
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' =>  __('Something went wrong. Please try again'),
                'data' => null
            ]);
        }

        return response()->json([
            'success' => true,
            'message' =>  __('Code has been sent to') . ' ' . $user->email,
            'data' => null
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $passwordResetCode = PasswordReset::where(['verification_code' => $request->reset_password_code, 'status' => PENDING_STATUS])->first();
        if (!empty($passwordResetCode)) {
            $latestResetCode = PasswordReset::where(['user_id' => $passwordResetCode->user_id, 'status' => PENDING_STATUS])->orderBy('id', 'desc')->first();
            if (($latestResetCode->verification_code != $request->reset_password_code)) {
                return response()->json([
                    'success' => false,
                    'message' =>   __('Your given reset password code is incorrect'),
                    'data' => null
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' =>   __('Your given reset password code is incorrect'),
                'data' => null
            ]);
        }

        if (!empty($passwordResetCode)) {
            $totalDuration = Carbon::now()->diffInMinutes($passwordResetCode->created_at);
            if ($totalDuration > EXPIRE_TIME_OF_FORGET_PASSWORD_CODE) {
                return response()->json([
                    'success' => false,
                    'message' =>  __('Your code has been expired. Please give your code with in') . EXPIRE_TIME_OF_FORGET_PASSWORD_CODE . __('minutes'),
                    'data' => null
                ]);
            }
            $user = User::where('id', $passwordResetCode->user_id)->first();
            if (empty($user)) {
                return response()->json([
                    'success' => false,
                    'message' =>  __('User not found'),
                    'data' => null
                ]);
            }
            $user->password = Hash::make($request->new_password);
            $user->update();
            $passwordResetCode->status = ACTIVE_STATUS;
            $passwordResetCode->update();

            return response()->json([
                'success' => true,
                'message' =>  __('Password is reset successfully'),
                'data' => null
            ]);
        }

        return response()->json([
            'success' => false,
            'message' =>   __('Your given reset password code is incorrect'),
            'data' => null
        ]);
    }

    public function socialLogin(SocialLoginRequest $request)
    {
        $service = new UserService();
        $response = $service->socialLogin($request);

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        $rules = [
            'device_type' => 'required|in:' . implode(",", ['android', 'ios']),
            'device_token' => 'required'
        ];

        $messages = [
            'device_type.required' => __('Device type is required'),
            'device_type.in' => __('Device type is invalid'),
            'device_token.required' => __('Device token is required'),
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = "";
            $e = $validator->errors()->all();
            foreach ($e as $error) {
                $errors .= $error . "\n";
            }
            $response = [
                'success' => false,
                'message' => $errors,
                'data' => null
            ];

            return response()->json($response);
        }
        try {
            MobileDevice::where(['user_id' => Auth::id(), 'device_type' => $request->device_type, 'device_token' => $request->device_token])->delete();

            $token = $request->user()->token();
            if (!empty($token)) {
                DB::table('oauth_access_tokens')->where('id', $token->id)->delete();
            }

            $response = [
                'success' => true,
                'message' => __('Logged out successfully'),
                'data' => null
            ];
        } catch (\Exception $exception) {
            $response = [
                'success' => false,
                'message' => __('Something went wrong. Please try again'),
                'data' => null
            ];
        }

        return response()->json($response);
    }

    public function districts(Request $request)
    {
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'districts' => districts($request->district)
            ]
        ]);
    }

    public function bloodGroups(Request $request)
    {
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'blood_groups' => bloodGroups($request->blood)
            ]
        ]);
    }

    public function genders(Request $request)
    {
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'genders' => genders($request->gender)
            ]
        ]);
    }

    public function getUserDetails()
    {
        $user = Auth::user();
        try {
            $data = [
                'name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
                'phone' => empty($user->phone) ? "" : $user->phone,
                'role' => $user->role,
            ];

            return [
                'success' => true,
                'message' => '',
                'data' => $data
            ];
        } catch (\Exception $exception) {
            return [
                'success' => false,
                'message' => __('Something went wrong. Please try again'),
                'data' => null
            ];
        }
    }

    public function upozilas(Request $request)
    {
        $allUpozilas = upozila();
        $results = [];
        foreach ($allUpozilas as $key => $val) {
            if ($val['district_id'] == $request->district_id) {
                $results[] = $val;
            }
        }

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'upozilas' => $results
            ]
        ]);
    }
}
