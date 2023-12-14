<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Mail\PasswordForget;
use App\Mail\VerifyEmail;
use App\Mail\WelcomeEmail;
use App\Models\Favourite;
use App\Models\Inventory;
use App\Models\Lead;
use App\Models\LeadMessage;
use App\Models\Tmp_inventory;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BuyerController extends Controller
{

public function login()
{
    return view('auth.buyer.login');
}
public function registerView()
{
    return view('auth.buyer.register');
}
public function register(Request $request)
{


   $request->validate([
    'first_name' => 'required|string',
    'last_name' => 'required|string',
    'email' =>'required|email|unique:users',
    // 'confirm_email' =>'required',
    'password' => 'required|min:6',
    'confirm_password' =>'required|same:password'
   ],
   [
    'required' => 'The :attribute field is required.',
    'email' => 'The :attribute must be a valid email address.',
    'same' => 'The :attribute must match the :other.',
    'min' => 'The :attribute must be at least :min characters.'
]);

        $buyer = new User();
        $buyer->username = $request->first_name .' '. $request->last_name;
        $buyer->fname = $request->first_name;
        $buyer->lname =  $request->last_name;
        $buyer->email = $request->email;
        $buyer->password = Hash::make($request->password);
        $buyer->save();
        $data =[
            'name' => $request->last_name ?? 'user',
            'id'=> $buyer->id,
            'password'=> $request->password
        ];
        Mail::to($request->email)->send(new VerifyEmail($data));
        return redirect()->route('buyer.login')->with('message','Registration successfully! please check mail and verify your email.');



}


public function loginCheck(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'captcha' => 'required|captcha',

   ], [
    'required' => 'The :attribute field is required.',
    'email' => 'The :attribute must be a valid email address.',
    'captcha.required' => 'The captcha field is required.',
    'captcha.captcha' => 'The captcha is incorrect.',
]);
        $verify_check = User::where('email',$request->email)->first();
        if($verify_check->is_verify_email == 1)
        {
            if (Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
            {
                $data =[
                    'id' => $verify_check->id,
                    'name'=> $verify_check->username,
                ];
                    Mail::to($request->email)->send(new WelcomeEmail($data));
               return redirect()->route('buyer.dashboard');

            }else
            {
                return  redirect()->back()->with('message','user name or password invalid!');
            }
        }else
        {
            return  redirect()->back()->with('message','Please Verify Your E-mail. Check E-mail');
        }


}

public function dashboard()
{
    $buyer = Auth::user();
    $favorites = Favourite::with('inventory')->where('user_id' , Auth::user()->id)->get();
    return view('buyer.home',compact('buyer','favorites'));
}

public function updateInfo(Request $request)
{


   $request->validate([
        'fname' =>'required|string',
        'lname' =>'required|string',
        'email' =>'required',
        'phone' =>'required',
   ],[
    'required' => 'The :attribute field is required.',
    'email' => 'The :attribute must be a valid email address.',
]);
   $buyer = User::find(auth()->user()->id);

   if ($request->hasFile('profile_img')) {
    $path = 'frontend/images/users/';
    $image = $request->file('profile_img');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $upload = $image->move(public_path($path), $imageName);
    if($buyer->img != null)
    {
        unlink(public_path($path) . $buyer->img);
    }
    $buyer->img = $imageName;

   }

   $buyer->username = $request->fname .' '. $request->lname;
   $buyer->fname = $request->fname;
   $buyer->lname = $request->lname;
   $buyer->email = $request->email;
   $buyer->phone = $request->phone;
   $buyer->address = $request->address;
   $buyer->save();
 return redirect()->back()->with('message','User Update successfully!');



}

public function favourite(Request $request)
{

     $favorites = collect(session('favourite'));
    $favoriteIds = $favorites->pluck('id')->toArray();
    $favorites = Inventory::whereIn('id', $favoriteIds)->paginate(10);

    return view('buyer.favourite',compact('favorites'));
}


public function Savefavourite(Request $request)
{

        $check_inventory = Favourite::where('inventory_id',$request->id)->first();
    if($check_inventory)
    {
        if($check_inventory->status == 1)
        {
            $check_inventory->status =0;
            $check_inventory->save();
            return response()->json(['success'=>false]);
        }

    }else
    {
        $favourite_add = new Favourite();
        $favourite_add->user_id = auth()->user()->id;
        $favourite_add->inventory_id = $request->id;
        $favourite_add->status = 1;
        $favourite_add->save();
        return response()->json(['success'=>true]);
    }


}


public function forgotPassword(Request $request)
{
    $validator = Validator::make($request->all(),[
        'email' => 'required|email',
    ]);

    if($validator->fails())
    {
        return response()->json(['error' =>$validator->errors()]);

    }

    $check_user = User::where('email',$request->email)->first();
    if($check_user)
    {
        $check_user->password_reset_otp = rand(1234,999999);
        $check_user->save();
        Session::put('email', $request->email);
        $data = [
            'name' => $check_user->username,
            'email' => $check_user->email,
            'otp' =>  $check_user->password_reset_otp,
        ];
        Mail::to($data['email'])->send(new PasswordForget($data));
       return response()->json(['success' => 'OTP sent successfully! check e-mail']);

    }else
    {
        return response()->json(['error'=>'user not found']);
    }


}


public function checkOtp(Request $request)
{

    $validator = Validator::make($request->all(),[
        'otp'=>'required',
        'password' =>'required|min:6',
        'confirm_password' =>'required|same:password'
    ]);

    if($validator->fails())
    {
        return response()->json($validator->errors());
    }
    $user = User::where('email', Session::get('email'))->first();
    if($request->otp != $user->password_reset_otp)
    {
        return response()->json(['error'=>'your otp is invalid']);

    }else
    {
        $user->password = Hash::make($request->password);
        $user->password_reset_otp = null;
        $user->save();
        return response()->json(['message'=>'Reset Password Successfully.Please LogIn']);

    }

}


public function message()
{
    // $ids = LeadMessage::where('receiver_id',Auth::user()->id)->get();
    // return $ids;
    $lead_messages = LeadMessage::with('user','lead')->where(['sender_id' => Auth::user()->id])
    ->orWhere(['receiver_id' => Auth::user()->id])
    ->get();
    // return $messages;




    return view('buyer.message',compact('lead_messages'));
}

public function userVerify($id,$password =null)
{

    $user = User::find($id);
    if ($user) {
        $user->is_verify_email = 1;
        // Ensure to hash the password if you are updating it
        // $user->password = bcrypt($request->password);

        $user->save();

        if ($user->role == 0) {
            if (Auth::attempt(['email' => $user->email, 'password' => $password])) {

                $data =[
                    'id' => $user->id,
                    'name'=> $user->username,
                ];

                    Mail::to($user->email)->send(new WelcomeEmail($data));

                return redirect('/buyer/favorite')->with('message', 'Your Email Verified Successfully! welcome to dashboard');

            } else {
                return redirect('/buyer/login')->with('message', 'Email verified but unable to login. Please try again.');
            }
        } else {
            return redirect('/login')->with('message', 'Your Email Verified Successfully! Please login');
        }
    } else {
        // Handle the case where the user is not found
        // Redirect or show an error message
    }

}

public function messageCollect(Request $request){
    $messages = LeadMessage::where('lead_id', $request->lead_id)->get();

//    $messages = LeadMessage::where('sender_id',$request->sender_id)->where('receiver_id',Auth::id())->where('lead_id',$request->lead_id )->get();
//    $reciever_id =  $messages[0]->sender_id;
//    $recieved_messages = LeadMessage::where('sender_id',Auth::id())->where('receiver_id',$reciever_id)->where('lead_id',$request->lead_id )->get();
//    dd($recieved_messages);

//    return  $messages;






return response()->json([
    'status'=>'success',
    'data'=> $messages,
    // 'receive'=>$recieved_messages,
    // 'time'=>$formattedTime,
    // 'sender_time'=>$formattedSenderTime,


]);

}

public function add(Request $request){


    $message = new LeadMessage();
    if ($request->hasFile('image')) {
        $path = 'dashboard/images/lead_report/';
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $imageName);
        $message->file = $imageName;
    }
            $message->sender_id = auth()->user()->id;
            $message->receiver_id =$request->receiver_id;
            $message->lead_id = $request->lead_id;

            $message->message = $request->message;
            $message->save();
            return redirect('buyer/message');
}


}
