<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CarImport;
use App\Interface\InventoryServiceInterface;
use App\Mail\PasswordForget;
use App\Mail\VerifyEmail;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DealerController extends Controller
{
    private $inventoryService;
    public function __construct(InventoryServiceInterface $inventoryService){
        $this->inventoryService = $inventoryService;
    }

    public function index()
    {
        $inventories = $this->inventoryService->all()->count();
        $leads = Lead::all()->count();
        return view('dealer.home',compact('inventories','leads'));
    }
    public function register()
    {
        return view('auth.register');
    }

    public function saveData(Request $request)
    {
       $request->validate([
            'fname'=>'required|string',
            'lname'=>'required|string',
            'email' =>'required|email|unique:users',
            'phone' =>'required|min:11',
            'password' =>'required|min:6',
            'confirm_password'=>'required|same:password'
       ],[
        'required' => 'The :attribute field is required.',
        'email' => 'The :attribute must be a valid email address.',
        'same' => 'The :attribute must match the :other.',
        'min' => 'The :attribute must be at least :min characters.',
        'unique' => 'The :attribute has already been taken.'
    ]);

       $dealer = new User();
       $dealer->username = $request->fname . $request->lname;
       $dealer->fname = $request->fname ;
       $dealer->lname =  $request->lname;
       $dealer->email = $request->email;
       $dealer->phone = $request->phone;
       $dealer->role = 2;
       $dealer->password = Hash::make($request->password);
       $dealer->save();
       $data =[
        'name'=> $request->fname,
        'id'=> $dealer->id,
        'password'=> $request->password,
    ];
        Mail::to($request->email)->send(new VerifyEmail($data));

        // session()->put('message','Registration successfully! please check mail and verify your email.');

       return redirect()->route('login')->with('message','Registration successfully! please check mail and verify your email.');


    }

    // public function loginCheck(Request $request)
    // {
    //    $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //    ]);


    //    if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
    //    {

    //     return redirect()->route('dealer.dashboard');

    //    }else
    //    {
    //     return "credential do not match!";
    //    }

    // }

    public function dashboard()
    {
        return view('dealer.dealer_home');
    }

    // public function import()
    // {
    //     // $cars = Car::orderBy('id','desc')->paginate(6);
    //     $cars = $this->inventoryService->all()->paginate(6);
    //     return view('dealer.car_import', compact('cars'));
    // }

    // public function importStore(Request $request)
    // {
    //     // abort_if(! auth()->user()->can('hrm_bulk_attendance_import_store'), 403, 'Access forbidden');
    //     $request->validate([
    //         'import_file' => 'required|mimes:csv,xlx,xlsx,xls',
    //     ]);

    //     Excel::import(new CarImport, $request->import_file);
    //     session()->flash('success','Car Imported successfully!');
    //     return redirect()->route('car.import');
    // }



    // public function invoice()
    // {
    // //    $inventories = Inventory::with('user')->where('package',1)->where('user_id',$id)->get();
    // //    return $inventories;
    //     return view('admin.dealer.invoice');
    // }

    public function invoice_generate($id)
    {
    //    $inventories =Inventory::with('user')->where('package',1)->where('user_id',$id)->get();

        //return view('admin.dealer.download_invoice',compact('inventories'));

        // return view('admin.dealer.download_invoice',compact('inventory'));
        // $inventories = Invoice::with('inventory')->where('inventory_id',$id)->get();
        // $pdf = PDF::loadView('admin.dealer.download_invoice');
        // $pdf = FacadePdf::loadView('admin.dealer.invoice_demo',compact('inventory'));

        // return $pdf->download('invoice_ '.rand(1234,9999).'.pdf');

    // return $id;

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





}
