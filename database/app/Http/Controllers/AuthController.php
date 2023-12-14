<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 6/1/19
 * Time: 5:54 PM
 */

namespace App\Http\Controllers;


use App\Models\PasswordReset;
use App\Models\Subscriber;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!empty($user) && $user->role == SUPER_ADMIN_ROLE) {
            return redirect()->route('superAdmin.dashboard');
        } elseif (!empty($user) && $user->role == ADMIN_ROLE) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('signIn');
        }
    }

    public function signIn()
    {
        return view('auth.login');
    }

    public function signInProcess(Request $request)
    {
        if (empty($request->email) && empty($request->password)) {
            return redirect()->back()->with(['error' => __('Email and password can not be empty')]);
        }
        $credentials = $this->credentials($request->except('_token'));
        $valid = Auth::attempt($credentials);
        if ($valid) {
            $user = Auth::user();
            if ($user->role == SUPER_ADMIN_ROLE) {
                return redirect()->route('superAdmin.dashboard');
            } elseif ($user->role == ADMIN_ROLE) {
                if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                    Auth::logout();

                    return redirect()->route('signIn')->with(['error' => __('Please enter your username instead of email')]);
                }
                $subscriber = Subscriber::whereHas('customer', function ($where) {
                                    $where->whereHas('user', function ($user) {
                                        $user->where(['id' => Auth::id()]);
                                    });
                                })->first();
                $subscriberEndDate = new Carbon($subscriber->end_date);
                $subscriberStartDate = new Carbon($subscriber->start_date);
                $carbon = new Carbon();
                if ($subscriberStartDate->format('Y-m-d') > $carbon->now()->format('Y-m-d')) {
                    Auth::logout();

                    return redirect()->route('signIn')->with(['error' => __('subscription package has not started yet')]);
                }
                if ($subscriberEndDate->format('Y-m-d') < $carbon->now()->format('Y-m-d')) {
                    Auth::logout();

                    return redirect()->route('signIn')->with(['error' => __('Your subscription package has been expired')]);
                }

                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('signIn')->with(['error' => __('You are not authorized')]);
            }
        } else {
            return redirect()->back()->with(['error' => __('Email or password is incorrect')]);
        }
    }

    public function credentials($data)
    {
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return [
                'email' => $data['email'],
                'password' => $data['password']
            ];
        } else {
            return [
                'user_name' => $data['email'],
                'password' => $data['password']
            ];
        }
    }

    public function signOut()
    {
        Auth::logout();
        session()->flush();

        return redirect()->route('signIn');
    }

    public function passwordChange()
    {
        $data['menuName'] = __('Change Password');

        return view('auth.password-change', $data);
    }

    public function passwordChangeProcess(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ];

        $messages = [
            'old_password.required' => __('Old password can not be empty'),
            'new_password.required' => __('New password can not be empty'),
            'new_password.min' => __('New password must be al least 8 characters'),
            'confirm_password.required' => __('Confirm password can not be empty'),
            'confirm_password.same' => __('New password and confirm password are not same')
        ];

        $this->validate($request, $rules, $messages);

        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->update();

            return redirect()->back()->with(['success' => __('Password is changed successfully')]);
        }

        return redirect()->back()->with(['error' => __('Your given old password is incorrect')]);
    }

    public function forgetPassword()
    {
        return view('auth.forget_password_email');
    }

    public function forgetPasswordEmailSendProcess(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $where = ['email' => $request->email];
        } else {
            $where = ['user_name' => $request->email];
        }
        $user = User::where($where)->first();
        if (empty($user)) {
            return redirect()->back()->with(['error' => __('User not found')]);
        }

        if ($user->role == ADMIN_ROLE) {
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                return redirect()->back()->with(['error' => __('Please enter your username instead of email')])->withInput();
            }
        }

        $randNo = randomNumber(6);
        try {
            $defaultEmail = empty(allsetting('primary_email')) ? 'noreply@apperoni.org' : allsetting('primary_email');
            $defaultName = empty(allsetting('company')) ? 'Apperoni' : allsetting('company');

            Mail::send('email.forget_password', ['key' => $randNo, 'company' => $defaultName, 'logo' => allSetting('main_logo') ? asset(logoViewPath() . allSetting('main_logo')) : asset('assets/images/logo.png')], function ($message) use ($user, $defaultEmail, $defaultName) {
                $message->to($user->email)->subject(__('Forget Password'))->from(
                    $defaultEmail, $defaultName
                );
            });
            PasswordReset::create([
                'user_id' => $user->id,
                'verification_code' => $randNo
            ]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong. Please try again')]);
        }

        return redirect()->route('forgetPasswordCode')->with(['success' => __('Code has been sent to') . $user->email]);
    }

    public function forgetPasswordCode()
    {
        return view('auth.forget_password');
    }

    public function forgetPasswordCodeProcess(Request $request)
    {
        $rules = [
            'reset_password_code' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ];

        $messages = [
            'reset_password_code.required' => __('Reset password code can not be empty'),
            'new_password.required' => __('New password can not be empty'),
            'new_password.min' => __('New password must be al least 8 characters'),
            'confirm_password.required' => __('Confirm password can not be empty'),
            'confirm_password.same' => __('New password and confirm password are not same'),
        ];

        $this->validate($request, $rules, $messages);

        $passwordResetCode = PasswordReset::where(['verification_code' => $request->reset_password_code, 'status' => PENDING_STATUS])->first();
        $latestResetCode = PasswordReset::where(['user_id' => $passwordResetCode->user_id, 'status' => PENDING_STATUS])->orderBy('id', 'desc')->first();
        if (empty($latestResetCode) || ($latestResetCode->verification_code != $request->reset_password_code)) {
            return redirect()->back()->with(['error' => __('Your given reset password code is incorrect')]);
        }
        
        if (!empty($passwordResetCode)) {
            $totalDuration = Carbon::now()->diffInMinutes($passwordResetCode->created_at);
            if ($totalDuration > EXPIRE_TIME_OF_FORGET_PASSWORD_CODE) {
                return redirect()->back()->with(['error' => __('Your code has been expired. Please give your code with in') . EXPIRE_TIME_OF_FORGET_PASSWORD_CODE . __('minutes')]);
            }
            $user = User::where('id', $passwordResetCode->user_id)->first();
            if (empty($user)) {
                return redirect()->back()->with(['error' => __('No user found')]);
            }
            $user->password = Hash::make($request->new_password);
            $user->update();
            $passwordResetCode->status = ACTIVE_STATUS;
            $passwordResetCode->update();

            return redirect()->route('signIn')->with(['success' => __('Password is reset successfully')]);
        }

        return redirect()->back()->with(['error' => __('Your given reset password code is incorrect')]);
    }
}
