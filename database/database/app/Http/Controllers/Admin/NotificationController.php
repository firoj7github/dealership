<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\PushNotificationService;
use App\Http\Services\SmsNotificationService;
use App\Jobs\SendEmailCampaignsJob;
use App\Models\MobileDevice;
use App\Models\NewsFeed;
use App\Models\NotificationHistory;
use App\Models\Subscriber;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function pushNotification()
    {
        $data['mainMenu'] = 'campaigns';
        $data['menuName'] = __('Campaigns');
        $data['subMenu'] = 'pushNotification';
        $data['subMenuName'] = __('Push Notification');
        $data['allNews'] = $news = NewsFeed::whereHas('customer', function ($query) {
            $query->whereHas('user', function ($where) {
                $where->where(['id' => Auth::id()]);
            });
        })->where(['status' => ACTIVE_STATUS])->get();

        return view('admin.campaigns.push-notification', $data);
    }

    public function sendPushNotification(Request $request)
    {
        $rules = [
            'title' => 'required',
            'body' => 'required|max:250'
        ];

        $messages = [
            'title.required' => __('Notification title can not be empty'),
            'body.required' => __('Notification body can not be empty'),
            'body.max' => __('Notification body can not greater than 250 characters'),
        ];

        $this->validate($request, $rules, $messages);
        $credit = $this->_checkPushNotificationCredit();
        if ($credit['status']) {
            return redirect()->back()->with(['error' => __('You don\'t have enough credit. Please contact with support')]);
        }

        $service = new PushNotificationService();
        try {
            $input = [
                'title' => $request->title,
                'body' => $request->body,
                'news' => empty($request->news) ? "" : $request->news,
                'subscriber_id' => isset(Auth::user()->customer->subscriber) ? Auth::user()->customer->subscriber->id : null
            ];
            $service->send($request->title, $request->body, $input);

            $this->_createNotificationHistory(__('Push Notification'), $request->body, $credit['number_of_users'], $credit['credit_needed']);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong. Please try again')]);
        }

        return redirect()->back()->with(['success' => __('Push notification is sent successfully')]);
    }

    private function _checkPushNotificationCredit()
    {
        $user = Auth::user();
        $numberOfUsers = MobileDevice::whereHas('users', function ($users) {
            $users->whereHas('subscriber', function ($subscriber) {
                $subscriber->whereHas('customer', function ($customer) {
                    $customer->where('user_id', Auth::id());
                });
            });
        })->count();
        $creditNeeded = allSetting('push_notification_cost') * $numberOfUsers;

        if ($creditNeeded > $user->customer->subscriber->credit) {
            return [
                'status' => true,
                'number_of_users' => $numberOfUsers,
                'credit_needed' => $creditNeeded
            ];
        }

        return [
            'status' => false,
            'number_of_users' => $numberOfUsers,
            'credit_needed' => $creditNeeded
        ];
    }

    private function _checkCredit($type)
    {
        $user = Auth::user();
        $numberOfUsers = User::where(['subscriber_id' => $user->customer->subscriber->id, 'status' => ACTIVE_STATUS, 'role' => USER_ROLE])->count();
        $creditNeeded = allSetting($type . '_notification_cost') * $numberOfUsers;

        if ($creditNeeded > $user->customer->subscriber->credit) {
            return [
                'status' => true,
                'number_of_users' => $numberOfUsers,
                'credit_needed' => $creditNeeded
            ];
        }

        return [
            'status' => false,
            'number_of_users' => $numberOfUsers,
            'credit_needed' => $creditNeeded
        ];
    }

    private function _createNotificationHistory($type, $details, $numberOfUsers, $creditNeeded)
    {
        $subscriber = Subscriber::whereHas('customer', function ($query) {
            $query->whereHas('user', function ($where) {
                $where->where(['id' => Auth::id()]);
            });
        })->first();

        $subscriber->decrement('credit', $creditNeeded);

        NotificationHistory::create([
            'customer_id' => Auth::user()->customer->id,
            'notification_type' => $type,
            'notification_details' => $details,
            'number_of_users' => $numberOfUsers,
            'credit_used' => $creditNeeded
        ]);
    }

    public function smsNotification()
    {
        $data['mainMenu'] = 'campaigns';
        $data['subMenu'] = 'smsNotification';
        $data['menuName'] = __('Campaigns');
        $data['subMenuName'] = __('Sms Notification');


        return view('admin.campaigns.sms-notification', $data);
    }

    public function sendSmsNotification(Request $request)
    {
        $rules = [
            'body' => 'required|max:160'
        ];

        $messages = [
            'body.required' => __('Notification body can not be empty'),
            'body.max' => __('Sms can not greater than 160 characters'),
        ];

        $this->validate($request, $rules, $messages);

        $credit = $this->_checkCredit('sms');
        if ($credit['status']) {
            return redirect()->back()->with(['error' => __('You don\'t have enough credit. Please contact with support')]);
        }

        $service = new SmsNotificationService();
        try {
            $response = $service->send($request->body);
            if (!$response['status']) {
                return redirect()->back()->with(['error' => __('Something went wrong. Please try again')]);
            }


            $creditNeeded = allSetting('sms_notification_cost') * $response['numberOfUsers'];
            $this->_createNotificationHistory(__('SMS Notification'), $request->body, $response['numberOfUsers'], $creditNeeded);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong. Please try again')]);
        }

        return redirect()->back()->with(['success' => __('Sms notification is sent successfully')]);
    }

    public function campaignHistory(Request $request)
    {
        if ($request->ajax()) {
            $history = NotificationHistory::whereHas('customer', function ($query) {
                $query->whereHas('user', function ($where) {
                    $where->where(['id' => Auth::id()]);
                });
            });

            return datatables($history)->make(true);
        }
        $data['mainMenu'] = 'campaigns';
        $data['subMenu'] = 'campaignHistory';
        $data['menuName'] = __('Campaigns');
        $data['subMenuName'] = __('Campaign History');

        return view('admin.campaigns.history', $data);
    }

    public function emailNotification()
    {
        $data['mainMenu'] = 'campaigns';
        $data['subMenu'] = 'emailNotification';
        $data['menuName'] = __('Campaigns');
        $data['subMenuName'] = __('Email Notification');
        $data['allNews'] = $news = NewsFeed::whereHas('customer', function ($query) {
            $query->whereHas('user', function ($where) {
                $where->where(['id' => Auth::id()]);
            });
        })->get();

        return view('admin.campaigns.email-notification', $data);
    }

    public function sendEmailNotification(Request $request)
    {
        $rules = [
            'subject' => 'required',
            'image' => 'required|file',
            'body' => 'required|max:500',
        ];

        $messages = [
            'body.required' => __('Notification body can not be empty'),
            'image.required' => __('Image can not be empty'),
            'image.file' => __('Invalid image type'),
            'body.subject' => __('Subject can not be empty')
        ];

        $this->validate($request, $rules, $messages);

        $credit = $this->_checkCredit('email');
        if ($credit['status']) {
            return redirect()->back()->with(['error' => __('You don\'t have enough credit. Please contact with support')])->withInput();
        }

        try {
            $image = uploadFile($request->image, emailImagePath());
            $subscriber = Subscriber::whereHas('customer', function ($query) {
                $query->whereHas('user', function ($where) {
                    $where->where(['id' => Auth::id()]);
                });
            })->first();
            $user = Auth::user();
            $defaultName = $user->customer->company_name;
            $defaultEmail = $user->email;
            $data = [
                'color' => $subscriber->color_1,
                'logo' => asset(logoViewPath() . $subscriber->logo),
                'image' => asset(emailImageViewPath() . $image),
                'body' => $request->body,
                'subject' => $request->subject,
                'company' => $defaultName,
                'defaultName' => $defaultName,
                'defaultEmail' => $defaultEmail
            ];

            $emails = User::where(['subscriber_id' => $subscriber->id, 'role' => USER_ROLE, 'status' => ACTIVE_STATUS])->pluck('email')->toArray();
            if (!empty($request->news)) {
                $articles = NewsFeed::whereIn('id', $request->news)->get()->toArray();
                foreach ($articles as $article) {
                    $data['articles'][] = [
                        'image' => asset(newsImageViewPath() . $article['image']),
                        'news' => $article['news']
                    ];
                }
            }

            if (!empty($request->link)) {
                $data['link'] = $request->link;
            }

            if (count($emails) == 0) {
                return redirect()->back()->with(['error' => __('No user to send email')])->withInput();
            }

            dispatch(new SendEmailCampaignsJob($emails, $data))->onQueue('email-campaigns');

            $this->_createNotificationHistory(__('Email Notification'), $request->body, $credit['number_of_users'], $credit['credit_needed']);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong. Please try again')])->withInput();
        }

        return redirect()->back()->with(['success' => __('Email notification is sent successfully')]);
    }

    public function testEmailNotification(Request $request)
    {
        $rules = [
            'subject' => 'required',
            'image' => 'required|file',
            'body' => 'required',
        ];

        $messages = [
            'body.required' => __('Notification body can not be empty'),
            'image.required' => __('Image can not be empty'),
            'image.file' => __('Invalid image type'),
            'body.subject' => __('Subject can not be empty')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = "";
            $e = $validator->errors()->all();
            foreach ($e as $error) {
                $errors .= $error . "\n";
            }
            $response = [
                'status' => false,
                'message' => $errors
            ];

            return response()->json($response);
        }

        $image = uploadFile($request->image, emailImagePath());
        $subscriber = Subscriber::whereHas('customer', function ($query) {
            $query->whereHas('user', function ($where) {
                $where->where(['id' => Auth::id()]);
            });
        })->first();
        $user = Auth::user();
        $defaultName = $user->customer->company_name;
        $defaultEmail = $user->email;
        $data = [
            'color' => $subscriber->color_1,
            'logo' => asset(logoViewPath() . $subscriber->logo),
            'image' => asset(emailImageViewPath() . $image),
            'body' => $request->body,
            'company' => $defaultName,
        ];

        if (!empty($request->news)) {
            $articles = NewsFeed::whereIn('id', $request->news)->get()->toArray();
            foreach ($articles as $article) {
                $data['articles'][] = [
                    'image' => asset(newsImageViewPath() . $article['image']),
                    'news' => $article['news']
                ];
            }
        }

        if (!empty($request->link)) {
            $data['link'] = $request->link;
        }
        Mail::send('email.email-campaigns', $data, function ($message) use ($user, $defaultEmail, $defaultName, $request) {
            $message->to($user->email)->subject($request->subject)->from(
                $defaultEmail, $defaultName
            );
        });

        return response()->json([
            'status' => true,
            'message' => __('Email notification is sent to your email')
        ]);
    }
}
