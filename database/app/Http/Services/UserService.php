<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 8/9/19
 * Time: 12:21 PM
 */

namespace App\Http\Services;


use App\Http\Repository\UserRepository;
use App\Models\Appointment;
use App\Models\Donor;
use App\Models\MobileDevice;
use App\Models\Subscriber;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService extends CommonService
{
    public $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
        parent::__construct($this->repository);
    }

    public function deleteUser($id)
    {
        try {
            Appointment::where('user_id', $id)->delete();

            return $this->repository->delete($id);
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function signUp(Request $request)
    {
        if (empty(districts($request->district))) {
            return [
                'success' => false,
                'message' => __('Invalid district'),
                'data' => null
            ];
        }
        $subscriber = Subscriber::where(['id' => $request->subscriber_id, 'status' => ACTIVE_STATUS])->first();
        if (empty($subscriber)) {
            return [
                'success' => false,
                'message' => __('Invalid subscriber'),
                'data' => null
            ];
        }
        $subscriberEndDate = new Carbon($subscriber->end_date);
        $subscriberStartDate = new Carbon($subscriber->start_date);
        $carbon = new Carbon();
        if ($subscriberStartDate->format('Y-m-d') > $carbon->now()->format('Y-m-d')) {
            return [
                'success' => false,
                'message' => __('Your client\'s subscription package has not started yet'),
                'data' => null
            ];
        }
        if ($subscriberEndDate->format('Y-m-d') < $carbon->now()->format('Y-m-d')) {
            return [
                'success' => false,
                'message' => __('Your client\'s subscription package has been expired'),
                'data' => null
            ];
        }
        $hasEmail = User::where(['email' => $request->email, 'subscriber_id' => $subscriber->id, 'social_network_type' => $request->social_network_type])->first();
        if (!empty($hasEmail)) {
            return [
                'success' => false,
                'message' => __('This email is already used'),
                'data' => null
            ];
        }
        $hasPhone = User::where(['phone' => $request->phone, 'subscriber_id' => $subscriber->id])->first();
        if (!empty($hasPhone)) {
            return [
                'success' => false,
                'message' => __('This phone number is already used'),
                'data' => null
            ];
        }
        $randNo = randomNumber(6);
        $name = explode(' ', $request->name);
        $insert = [
            'subscriber_id' => $request->subscriber_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->get('password')),
            'first_name' => isset($name[0]) ? $name[0] : "",
            'last_name' => isset($name[1]) ? $name[1] : "",
            'role' => USER_ROLE,
            'status' => USER_ACTIVE_STATUS,
            'email_verification_code' => $randNo,
            'blood_group' => $request->blood_group,
            'city' => $request->district,
        ];
        $token = null;
        DB::beginTransaction();
        try {
            $user = $this->create($insert);
            MobileDevice::updateOrCreate([
                'user_id' => $user->id,
                'device_type' => $request->device_type,
                'device_token' => $request->device_token
            ]);
            Donor::create([
                'subscriber_id' => $request->subscriber_id,
                'added_by' => $user->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'blood_group' => $request->blood_group,
                'district' => $request->district,
                'upozila' => $request->upozila,
                'last_blood_donate_date' => $request->last_blood_donate_date,
                'gender' => $request->gender,
                'institute' => $request->institute,
            ]);
            if ($user) {
                $token = $user->createToken($request->get('email'))->accessToken;
            }
//            $defaultEmail = empty($subscriber->customer) ? 'noreply@apperoni.org' : $subscriber->customer->user->email;
//            $defaultName = empty($subscriber->customer) ? 'Apperoni' : $subscriber->customer->company_name;
//            $logo =  empty($subscriber->logo) ? asset('assets/images/logo.png') : asset(logoViewPath() . $subscriber->logo);
//            Mail::send('email.email_verification', ['key' => $randNo, 'company' => $defaultName, 'logo' => $logo], function ($message) use ($user, $defaultEmail, $defaultName) {
//                $message->to($user->email)->subject(__('Email Verification'))->from(
//                    $defaultEmail, $defaultName
//                );
//            });
            DB::commit();
            $response = [
                'success' => true,
                'message' => __("Successfully Signed up!"),
                'data' => [
                    'access_token' => $token,
                    'access_type' => "Bearer",
                    'user_data' => [
                        'name' => $user->first_name . ' ' . $user->last_name,
                        'email' => $user->email,
                        'phone' => $user->phone
                    ]
                ]
            ];

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => __('Something went wrong. Please try again') . $exception->getMessage(),
                'data' => null
            ];
        }
    }

    public function signIn(Request $request)
    {
        $user = User::where(['email' => $request->email, 'subscriber_id' => $request->subscriber_id])->first();

        if (!empty($user)) {
            if (!in_array($user->role, [USER_ROLE,  MEMBER_ROLE])) {
                return  [
                    'success' => false,
                    'message' => __("This is not user email"),
                    'data' => null
                ];
            }
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken($request->email)->accessToken;
//                if ($user->email_verification_code == null && $user->status == USER_ACTIVE_STATUS) {
                if ($user->status == USER_ACTIVE_STATUS) {
                    $response = [
                        'success' => true,
                        'email_verification' => true,
                        'message' => __("Successfully Signed in!"),
                        'data' => [
                            'access_token' => $token,
                            'access_type' => "Bearer",
                            'user_data' => [
                                'name' => $user->first_name . ' ' . $user->last_name,
                                'email' => $user->email,
                                'phone' => $user->phone,
                                'role' => $user->role,
                            ]
                        ]
                    ];
                } elseif ($user->email_verification_code != null && $user->status == USER_PENDING_STATUS) {
                    $response = [
                        'success' => true,
                        'email_verification' => false,
                        'message' => __("Your account is not verified. Please verify your account."),
                        'data' => [
                            'access_token' => $token,
                            'access_type' => "Bearer",
                            'user_data' => [
                                'name' => $user->first_name . ' ' . $user->last_name,
                                'email' => $user->email,
                                'phone' => $user->phone,
                                'role' => $user->role,
                            ]
                        ]
                    ];
                } else {
                    throw new AuthenticationException('You are not authorized');
                }
                MobileDevice::updateOrCreate([
                    'user_id' => $user->id,
                    'device_type' => $request->device_type,
                    'device_token' => $request->device_token
                ]);
            } else {
                $response = [
                    'success' => false,
                    'message' => __("Email or Password doesn't match"),
                    'data' => null
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => __("This email does not exist"),
                'data' => null
            ];
        }

        return $response;
    }

    public function getUserProfile()
    {
        $user = Auth::user();
        try {
            $data = [
                'name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
                'phone' => empty($user->phone) ? "" : $user->phone
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

    public function updateUserProfile(Request $request)
    {
        $authUser = Auth::user();
        $hasEmail = User::where(['email' => $request->email, 'subscriber_id' => $authUser->subscriber_id])->where('is_social_login', '!=', 1)->where('id' , '!=', Auth::id())->first();
        if (!empty($hasEmail)) {
            return [
                'success' => false,
                'message' => __('This email is already used'),
                'data' => null
            ];
        }

        $hasPhone = User::where(['phone' => $request->phone, 'subscriber_id' => $authUser->subscriber_id])->where('id' , '!=', Auth::id())->first();
        if (!empty($hasPhone)) {
            return [
                'success' => false,
                'message' => __('This phone number is already used'),
                'data' => null
            ];
        }

        DB::beginTransaction();
        try {
            $authorized = true;
            $name = explode(' ', $request->name);
            $data = [
                'first_name' => isset($name[0]) ? $name[0] : "",
                'last_name' => isset($name[1]) ? $name[1] : "",
                'email' => $request->email,
                'phone' => $request->phone,
            ];
            if ($request->phone != $authUser->phone) {
                $data['is_phone_verified'] = PENDING_STATUS;
            }

            if ($request->email != $authUser->email) {
                $user = $authUser;
                if ($user->is_social_login) {
                    DB::rollBack();

                    return [
                        'success' => false,
                        'message' => __('You can not change your email'),
                        'data' => [
                            'authorized' => $authorized
                        ]
                    ];
                }

                $randNo = randomNumber(6);
                $data['status'] = USER_PENDING_STATUS;
                $data['email_verification_code'] = $randNo;
                $authorized = false;
                $subscriber = Subscriber::where(['id' => $user->subscriber_id])->first();
                $defaultEmail = empty($subscriber->customer) ? 'noreply@apperoni.org' : $subscriber->customer->user->email;
                $defaultName = empty($subscriber->customer) ? 'Apperoni' : $subscriber->customer->company_name;
                $logo =  empty($subscriber->logo) ? asset('assets/images/logo.png') : asset(logoViewPath() . $subscriber->logo);
                Mail::send('email.email_verification', ['key' => $randNo, 'company' => $defaultName, 'logo' => $logo], function ($message) use ($user, $defaultEmail, $defaultName) {
                    $message->to($user->email)->subject(__('Email Verification'))->from(
                        $defaultEmail, $defaultName
                    );
                });
            }
            $this->update(['id' => Auth::id()], $data);
            DB::commit();

            return [
                'success' => true,
                'message' => __('Your profile has been updated successfully'),
                'data' => [
                    'authorized' => $authorized
                ]
            ];
        } catch (\Exception $exception) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => __('Something went wrong. Please try again'),
                'data' => null
            ];
        }
    }

    public function socialLogin(Request $request)
    {
        $subscriber = Subscriber::where(['id' => $request->subscriber_id, 'status' => ACTIVE_STATUS])->first();
        if (empty($subscriber)) {
            return [
                'success' => false,
                'message' => __('Invalid subscriber'),
                'data' => null
            ];
        }
        $subscriberEndDate = new Carbon($subscriber->end_date);
        $carbon = new Carbon();
        if ($subscriberEndDate->format('Y-m-d') < $carbon->now()->format('Y-m-d')) {
            return [
                'success' => false,
                'message' => __('Your client\'s subscription package has been expired'),
                'data' => null
            ];
        }

        DB::beginTransaction();
        try {
            $name = explode(' ', $request->name);
            $insert = [
                'subscriber_id' => $request->subscriber_id,
                'email' => $request->email,
                'password' => Hash::make($request->get('password')),
                'first_name' => isset($name[0]) ? $name[0] : "",
                'last_name' => isset($name[1]) ? $name[1] : "",
                'role' => USER_ROLE,
                'status' => USER_ACTIVE_STATUS,
                'is_social_login' => true,
                'social_network_id' => $request->social_network_id,
                'social_network_type' => $request->social_network_type
            ];

            $user = User::updateOrCreate([
                'subscriber_id' => $request->subscriber_id,
                'email' => $request->email,
                'is_social_login' => 1,
                'social_network_type' => $request->social_network_type
            ], $insert);
            MobileDevice::updateOrCreate([
                'user_id' => $user->id,
                'device_type' => $request->device_type,
                'device_token' => $request->device_token
            ]);
            DB::commit();
            $token = null;
            if ($user) {
                $token = $user->createToken($request->get('email'))->accessToken;
            }

            $response = [
                'success' => true,
                'email_verification' => true,
                'message' => __("Successfully Signed in!"),
                'data' => [
                    'access_token' => $token,
                    'access_type' => "Bearer",
                    'user_data' => [
                        'name' => $user->first_name . ' ' . $user->last_name,
                        'email' => $user->email,
                        'phone' => empty($user->phone) ? "" : $user->phone
                    ]
                ]
            ];
        } catch (\Exception $exception) {
            DB::rollBack();
            $response = [
                'success' => false,
                'message' => __('Something went wrong. Please try again') . $exception->getMessage(),
                'data' => null
            ];
        }


        return $response;
    }
}
