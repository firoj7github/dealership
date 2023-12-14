<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 9/6/19
 * Time: 3:27 PM
 */

namespace App\Http\Services;


use Aloha\Twilio\Twilio;
use App\Models\Subscriber;
use App\User;
use Illuminate\Support\Facades\Auth;

class SmsNotificationService
{
    public function send($message)
    {
        try {
            $subscriber = Subscriber::whereHas('customer', function ($customer) {
                $customer->whereHas('user', function ($user) {
                    $user->where(['id' => Auth::id()]);
                });
            })->first();

            $users = User::where(['subscriber_id' => $subscriber->id, 'is_phone_verified' => ACTIVE_STATUS, 'status' => ACTIVE_STATUS])->get();
            $settings = allSetting(['twilio_sid', 'twilio_token', 'twilio_from']);
            $twilio = new Twilio($settings['twilio_sid'], $settings['twilio_token'], $settings['twilio_from']);
            $count = 0;
            foreach ($users as $user) {
                try {
                    $twilio->message($user->phone, $message);
                } catch (\Exception $exception) {
                    continue;
                }
                $count++;
            }

            return [
                'status' => true,
                'numberOfUsers' => $count
            ];
        } catch (\Exception $exception) {
            return [
                'status' => false,
                'numberOfUsers' => 0
            ];
        }
    }
}