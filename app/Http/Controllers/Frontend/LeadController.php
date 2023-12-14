<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmPassword;
use App\Mail\WaitingEmail;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\LeadMessage;
use App\Models\Tmp_inventory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function leadStore(Request $request)
    {

        // return $request->all();



        // return view('email.confirm_password');
        $user = new User();
        $lead = new Lead();
        $message = new LeadMessage();
        $userInfo =[];
        if ($request->ajax()) {

            $validator = Validator::make($request->all(),[
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required',
                'description' => 'required',
                'captcha' => 'required|captcha',
            ], [
                'first_name.required' => 'The first name field is required.',
                'last_name.required' => 'The last name field is required.',
                'email.required' => 'The email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'phone.required' => 'The phone field is required.',
                'description.required' => 'The description field is required.',
                'captcha.required' => 'The captcha field is required.',
                'captcha.captcha' => 'The captcha validation failed. Please try again.',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            }


            $userCheck = User::where('email',$request->email)->first();

            if(!$userCheck)
            {
                $user->username = $request->first_name . ' ' . $request->last_name;
                $user->fname = $request->first_name;
                $user->lname = $request->last_name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                // $user->password = Hash::make($request->phone);
                $user->save();


                $lead->user_id = $user->id;
                $userInfo =[
                    'name' => $user->username,
                    'id' => $user->id,
                    'email' => $user->email,

                ];
                $lead->inventory_id = $request->tmp_inventories_id;
                $lead->date = now()->format('Y-m-d');
                $lead->description = $request->description;
                $lead->year = $request->year;
                $lead->make = $request->make;
                $lead->model = $request->model;
                $lead->mileage = $request->mileage;
                $lead->color = $request->color;
                $lead->vin = $request->vin;
                // $lead->tmp_inventories_id = $request->tmp_inventories_id;


                if ($request->isEmailSend != null) {
                    $lead->isEmailSend = $request->isEmailSend;
                }

                $lead->save();
                $message->message = $request->description;
                $message->sender_id = $user->id;
                $message->receiver_id = $request->user_id;
                $message->lead_id = $lead->id;
                $message->save();
            $this->sendMail($userInfo);
            $this->waitingMail($userInfo);
            }else
            {
                $lead->user_id = $userCheck->id;
                $userInfo =[
                    'name' => $userCheck->username,
                    'id' => $userCheck->id,
                    'email' => $userCheck->email,
                ];
                $lead->inventory_id = $request->tmp_inventories_id;
                $lead->date = now()->format('Y-m-d');
                $lead->description = $request->description;
                $lead->year = $request->year;
                $lead->make = $request->make;
                $lead->model = $request->model;
                $lead->mileage = $request->mileage;
                $lead->color = $request->color;
                $lead->vin = $request->vin;
                // $lead->tmp_inventories_id = $request->tmp_inventories_id;


                if ($request->isEmailSend != null) {
                    $lead->isEmailSend = $request->isEmailSend;
                }

                $lead->save();
                $message->message = $request->description;
                $message->sender_id = $user->id;
                $message->receiver_id = $request->user_id;
                $message->lead_id =$lead->id;
                $message->save();
                $this->waitingMail($userInfo);
            }



            return response()->json([
                'status'=>'success',
                'message' => 'Lead Sent Successfully!']);
        } else {

            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required',
                'description' => 'required',
                'captcha' => 'required|captcha',
            ], [
                'first_name.required' => 'First name required.',
                'last_name.required' => 'Last name required.',
                'email.required' => 'Email required.',
                'email.email' => 'Please enter a valid email address.',
                'phone.required' => 'Phone required.',
                'description.required' => 'Description required.',
                'captcha.required' => 'Captcha required.',
                'captcha.captcha' => 'The captcha is incorrect',
            ]);

            if ($request->year != null) {
                $request->validate([

                    'year' => 'required',
                    'make' => 'required',
                    'model' => 'required',
                    'mileage' => 'required',
                    'color' => 'required',
                ]);
            }

            $userCheck = User::where('email',$request->email)->first();

            if(!$userCheck)
            {


                $user->username = $request->first_name . ' ' . $request->last_name;
                $user->fname = $request->first_name;
                $user->lname = $request->last_name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                // $user->password = Hash::make($request->phone);
                $user->save();
                $lead->user_id = $user->id;
                $userInfo =[
                    'name' => $user->username,
                    'id' => $user->id,
                    'email' => $user->email,
                ];

            $lead->inventory_id = $request->tmp_inventories_id;
            $lead->date = now()->format('Y-m-d');
            $lead->description = $request->description;
            $lead->year = $request->year;
            $lead->make = $request->make;
            $lead->model = $request->model;
            $lead->mileage = $request->mileage;
            $lead->color = $request->color;
            $lead->vin = $request->vin;
            // $lead->tmp_inventories_id = $request->tmp_inventories_id;
            if ($request->isEmailSend != null) {
                $lead->isEmailSend = $request->isEmailSend;
            }
            $lead->save();
            $message->message = $request->description;
            $message->sender_id = $user->id;
            $message->receiver_id = $request->user_id;
            $message->lead_id = $lead->id;
            $message->save();
            $this->sendMail($userInfo);
            $this->waitingMail($userInfo);
            }else
            {
                $lead->user_id = $userCheck->id;
                $lead->inventory_id = $request->tmp_inventories_id;
                $lead->date = now()->format('Y-m-d');
                $lead->description = $request->description;
                $lead->year = $request->year;
                $lead->make = $request->make;
                $lead->model = $request->model;
                $lead->mileage = $request->mileage;
                $lead->color = $request->color;
                $lead->vin = $request->vin;
                // $lead->tmp_inventories_id = $request->tmp_inventories_id;
                if ($request->isEmailSend != null) {
                    $lead->isEmailSend = $request->isEmailSend;
                }
                $lead->save();
                $message->message = $request->description;
                $message->sender_id = $userCheck->id;
                $message->receiver_id = $request->user_id;
                $message->lead_id = $lead->id;
                // dd($userCheck->id);
                $message->save();

                $userInfo =[
                    'name' => $userCheck->username,
                    'id' => $userCheck->id,
                    'email' => $userCheck->email,
                ];
                $this->waitingMail($userInfo);
            }
            // $lead->inventory_id = $request->tmp_inventories_id;
            // $lead->date = now()->format('Y-m-d');
            // $lead->description = $request->description;
            // $lead->year = $request->year;
            // $lead->make = $request->make;
            // $lead->model = $request->model;
            // $lead->mileage = $request->mileage;
            // $lead->color = $request->color;
            // $lead->vin = $request->vin;
            // // $lead->tmp_inventories_id = $request->tmp_inventories_id;
            // if ($request->isEmailSend != null) {
            //     $lead->isEmailSend = $request->isEmailSend;
            // }
            // $lead->save();


            return redirect()->back()->with('message', 'Message Sent Successfully! please check email');
        }
    }

    private function sendMail($userInfo)
    {
        $data =[
            'name' => $userInfo['name'],
            'email'=> $userInfo['email'],
            'id'=> $userInfo['id'],
        ];
        Mail::to($userInfo['email'])->send(new ConfirmPassword($data));
    }

    private function waitingMail($userInfo)
    {
        $lead_details = Lead::with('inventories_car')->where('user_id',$userInfo['id'])->orderBy('id','desc')->first();
        // $car_name = $lead_details->vichele_name;
        $year = $lead_details->inventories_car->year;
        $make = $lead_details->inventories_car->make;
        $model = $lead_details->inventories_car->model;
        $price = $lead_details->inventories_car->price;
        $stock = $lead_details->inventories_car->stock;
        $miles = $lead_details->inventories_car->miles;
        $tradeInYear = $lead_details->year;
        $tradeInMake = $lead_details->make;
        $tradeInModel = $lead_details->model;
        $tradeInVin = $lead_details->vin;
        $tradeInMiles = $lead_details->mileage;
        $tradeInColor = $lead_details->color;
        $ext_color_generic = $lead_details->inventories_car->ext_color_generic;
        $img = $lead_details->inventories_car['image_from_url'];
        $image =  explode(',',$img);


        $data =[
            'id' =>$userInfo['id'],
            'name'=> $userInfo['name'],
            'description'=> $lead_details->description,
            'year'          => [$year,$tradeInYear],
            'make'          => [$make,$tradeInMake],
            'model'          => [$model,$tradeInModel],
            'price'             => $price,
            'stock'             => $stock,
            'miles'             => [$miles,$tradeInMiles],
            'vin'             => $tradeInVin,
            'color'             => [$ext_color_generic,$tradeInColor],
            'image'     => $image[0],
        ];
        Mail::to($userInfo['email'])->send(new WaitingEmail($data));

    }

    public function getLead(Request $request)
    {

        $temp_car_details = Tmp_inventory::find($request->id);
        return $temp_car_details;
    }
}
