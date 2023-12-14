<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\Favourite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

class CustomCheckAuth extends Controller
{
    use RegistersUsers;
    public function __construct()
    {
        $this->middleware('guest');
    }

   public function CheckAuth(Request $request)
   {
    $validator = Validator::make($request->all(),[
        'email' => 'required|email',

    ]);
    if($validator->fails())
    {
        return response()->json($validator->errors());
    }
    // return $request->email;
    $checkAuth = User::where('email',$request->email)->first();
    Session::put('email',$request->email);
    if($checkAuth)
    {
        return response()->json(['status'=>1,'email'=>$request->email]);

        // $html .=' <label>Password</label>
        // <input placeholder="Enter Your Password"
        //     class="form-control"
        //     type="text" name="password" id="password"
        //     style="width: 95% !important;">
        //     <a href="#" class="btn btn-danger" style="margin: 30px;float:right" id="login">Login</a>';

    }else
    {
        return response()->json(['status'=>0,'email'=>$request->email]);
        // $html .=' <label>First Name</label>
        // <input placeholder="Enter Your First Name"
        //     class="form-control"
        //     type="text" name="fname" id="fname"
        //     style="width: 95% !important;"><br/>

        //     <label>Last Name</label>
        // <input placeholder="Enter Your Last Name"
        //     class="form-control"
        //     type="text" name="lname" id="lname"
        //     style="width: 95% !important;"><br/>

        //     <label>E-mail</label>
        // <input placeholder="Enter Your Email"
        //     class="form-control"
        //     type="email" name="email" id="email"
        //     style="width: 95% !important;"><br/>

        //     <label>Password</label>
        // <input placeholder="Password"
        //     class="form-control"
        //     type="password" name="password" id="password"
        //     style="width: 95% !important;"><br/>

        //     <label>Confirm Password</label>
        // <input placeholder="Confirm Password"
        //     class="form-control"
        //     type="password" name="confirm_password" id="confirm_password"
        //     style="width: 95% !important;"><br/>
        //     <a href="#" class="btn btn-danger" style="margin: 30px;float:right" id="SignUp">signup</a>';

    }


   }

   public function login(Request $request)
   {

    $validator = Validator::make($request->all(),[
        'password' => 'required',

    ]);
    if($validator->fails())
    {
        return response()->json($validator->errors());
    }
    $email = Session::get('email');
    if (Auth::attempt(['email'=>$email,'password'=>$request->password]))
    {
        return response()->json(['action' => 'add', 'message' => 'Login successfully ']);
        // $countWishList = Favourite::countWishList($request->inventory_id);
        //     $wishlist = new Favourite();

        //     if($countWishList == 0){
        //         $wishlist->inventory_id = $request->inventory_id;
        //         $wishlist->user_id = Auth::user()->id;
        //         $wishlist->save();
        //         return response()->json(['action' => 'add', 'message' => 'Product added successfully to wishlist']);
        //     }else{
        //         $user =Auth::user()->id;
        //         Favourite::where(['user_id' => $user, 'inventory_id' => $request->inventory_id])->delete();
        //         return response()->json(['action' => 'remove', 'message' => 'Product removed successfully from wishlist']);
        //     }
    //    return response()->json(['message'=>'Product added successfully to wishlist']);
    }else
    {
        return response()->json(['error'=>'user name or password invalid!']);
    }


   }


   public function signup(Request $request)
   {
       $validator = Validator::make($request->all(),[
           'email' => 'required|email|unique:users',
           'password' => 'required|min:6',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
        }
        $user = new User();
        $user->username = 'localcarz user';
        $user->fname = 'localcarz';
        $user->lname = 'user';
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if (Auth::attempt(['email'=>$user->email,'password'=>$request->password]))
        {
            // $countWishList = Favourite::countWishList($request->inventory_id);
            //     $wishlist = new Favourite();

            //     if($countWishList == 0){
            //         $wishlist->inventory_id = $request->inventory_id;
            //         $wishlist->user_id = Auth::user()->id;
            //         $wishlist->save();
            //         // return response()->json(['action' => 'add', 'message' => 'Product added successfully to wishlist']);
            //     }
        //    return response()->json(['message'=>'Product added successfully to wishlist']);
        }

        $data =[
            'name' => 'user',
            'id'=> $user->id,
            'password'=> $request->password,
        ];
        Mail::to($request->email)->send(new VerifyEmail($data));


        // $wishlist = new Favourite();

        // dd($request->inventory_id. $user->id);

        // $wishlist->inventory_id = $request->inventory_id;
        // $wishlist->user_id = $user->id;
        // $wishlist->save();
        // return response()->json(['action' => 'add', 'message' => 'Product added successfully to wishlist']);

        return response()->json(['create'=>'Sign Up check E-mail ']);


   }
}
