<?php

namespace App\Http\Controllers\Api;

use Aloha\Twilio\Twilio;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LanguageSetRequest;
use App\Http\Requests\Api\PhoneVerificationRequest;
use App\Http\Requests\Api\UpdatePasswordRequest;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Services\UserService;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function getUserProfile()
    {
        $service = new UserService();
        $response = $service->getUserProfile();

        return response()->json($response);
    }

    public function updateUserProfile(UpdateProfileRequest $request)
    {
        $service = new UserService();
        $response = $service->updateUserProfile($request);

        return response()->json($response);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (Hash::check($reqgetVoulaintierListuest->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->update();

            return response()->json([
                'success' => true,
                'message' => __('Password is changed successfully'),
                'data' => null
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => __('Your given old password is incorrect'),
            'data' => null
        ]);
    }

    public function sendPhoneVerificationCode()
    {
        $user = Auth::user();
        if ($user->is_phone_verified == ACTIVE_STATUS) {
            return response()->json([
                'success' => false,
                'message' => __('Your phone is already verified'),
                'data' => null
            ]);
        }
        if (empty($user->phone)) {
            return response()->json([
                'success' => false,
                'message' => __('Please add your phone first'),
                'data' => null
            ]);
        }
        $randNo = randomNumber(6);
        try {
            $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
            $subscriber->decrement('credit', allSetting('sms_notification_cost'));
            $user->phone_verification_code = $randNo;
            $user->update();
            $settings = allSetting(['twilio_sid', 'twilio_token', 'twilio_from']);
            $twilio = new Twilio($settings['twilio_sid'], $settings['twilio_token'], $settings['twilio_from']);
            $twilio->message($user->phone, __('Your verification code is') . $randNo);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => __('Something went wrong. Please try again') . $exception->getMessage(),
                'data' => null
            ]);
        }

        $response = [
            'success' => true,
            'message' => __("Code has been sent to your phone"),
            'data' => null
        ];

        return response()->json($response);
    }

    public function phoneVerify(PhoneVerificationRequest $request)
    {
        $user = Auth::user();
        if ($user->phone_verification_code == $request->phone_verification_code) {
            DB::beginTransaction();
            try {
                $user->phone_verification_code = null;
                $user->is_phone_verified = ACTIVE_STATUS;
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
                'message' => __("Phone is verified successfully."),
                'data' => null
            ];
        } else {
            $response = [
                'success' => false,
                'message' => __("Phone verification code is invalid."),
                'data' => null
            ];
        }

        return response()->json($response);
    }

    public function languageList()
    {
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => [
                'languages' => languageFullName()
            ]
        ]);
    }

    public function setLanguage(LanguageSetRequest $request)
    {
        $user = Auth::user();
        $user->language = $request->language;
        $user->update();

        return response()->json([
                'success' => true,
                'message' => __('Language has been updated successfully'),
                'data' => null
            ]
        );
    }
}
