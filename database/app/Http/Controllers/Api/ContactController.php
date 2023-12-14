<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactUsRequest;
use App\Models\ContactUs;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function aboutUs()
    {
        $user = Auth::user();
        $subscriber = Subscriber::with('customer')->where(['id' => $user->subscriber_id, 'status' => ACTIVE_STATUS])->first();
        if (isset($subscriber->customer->user)) {
            $aboutUs = allSetting('about_us_' . $subscriber->customer->user->id);
            return response()->json([
                'success' => true,
                'message' => '',
                'data' => [
                    'about_us' => empty($aboutUs) ? '' : $aboutUs
                ]
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => '',
            'data' => [
                'about_us' => ''
            ]
        ]);
    }

    public function contactNumber()
    {
        $user = Auth::user();
        $subscriber = Subscriber::where(['id' => $user->subscriber_id, 'status' => ACTIVE_STATUS])->first();
        if (isset($subscriber->customer->user)) {
            $number = allSetting('phone_' . $subscriber->customer->user->id);
            return response()->json([
                'success' => true,
                'message' => '',
                'data' => [
                    'phone' => empty($number) ? '' : $number
                ]
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => '',
            'data' => [
                'phone' => ''
            ]
        ]);
    }

    public function contactUs(ContactUsRequest $request)
    {
        $user = Auth::user();
        $subscriber = Subscriber::where(['id' => $user->subscriber_id, 'status' => ACTIVE_STATUS])->first();
        DB::beginTransaction();
        try{
            ContactUs::create([
                'customer_id' => $subscriber->customer->id,
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            ]);
            $user = [
                'email' => $request->email,
                'name' => $request->name,
                'data_message' => $request->message,
            ];
            $defaultEmail = empty($subscriber->customer) ? 'noreply@apperoni.org' : $subscriber->customer->user->email;
            $defaultName = empty($subscriber->customer) ? 'Apperoni' : $subscriber->customer->company_name;
            $logo =  empty($subscriber->logo) ? asset('assets/images/logo.png') : asset(logoViewPath() . $subscriber->logo);
            Mail::send('email.contact_us', ['company' => $defaultName, 'logo' => $logo, 'name' => $user['name'], 'data_message' => $user['data_message']], function ($message) use ($user, $defaultEmail, $defaultName) {
                $message->to($user['email'])->subject(__(':company Support', ['company' => $defaultName]))->from(
                    $defaultEmail, $defaultName
                );
            });
            DB::commit();

            return response()->json([
                'success' => true,
                'data' => null,
                'message' => __('Message has been sent Successfully')
            ]);
        }catch (\Exception $exception){
            DB::rollBack();

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => __('Something went wrong. Please try again')
            ]);
        }
    }
}
