<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class DealerMonetizationController extends Controller
{
    // public function index(){
    //     $user= Auth::user();
    //     // return $user;
    //     return view('dealer.profile.dealerprofile', compact('user'));
    // }
    public function index(Request $request){

        if ($request->ajax()) {
            $data = User::where('id',Auth::id());

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('DT_RowIndex', function ($user) {
                        return $user->id; // Use any unique identifier for your rows
                    })

                    ->editColumn('img', function ($row) {



                        $imagePath = $row->img ? asset("/dashboard/images/users/{$row->img}") : asset('/dashboard/images/avatar.png');
                        return "<img src='{$imagePath}' width='10%'>";

                    })
                    ->addColumn('action', function ($row) {
                        $html =
                                '<a title="Edit" href="#" data-bs-toggle="modal" data-bs-target="#dealerUpdateModal" class="text-white btn btn-sm  btn-primary update_dealer_form text-white m-2"
                                    data-id="' . $row->id . '" data-fname="' . $row->fname . '" data-lname="' . $row->lname . '"
                                    data-email="' . $row->email . '" data-adf_email="' . $row->adf_email . '" data-address="' . $row->address . '" data-phone="' . $row->phone . '"><i class="fa fa-edit"></i></a>' .
                                '<a title="Delete" class="text-white btn btn-sm  btn-danger delete text-white delete_profile" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                        return $html;
                    })









                    ->rawColumns(['action','img'])
                    ->make(true);
        }
        return view('dealer.profile.dealerprofile');

    }



    public function own(Request $request){
        if($request->ajax()){
            $data = Banner::where('user_id',Auth::id())->orderby('id','desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
                    ->addColumn('DT_RowIndex', function ($user) {
                        return $user->id; // Use any unique identifier for your rows
                    })

            ->editColumn('image', function ($row) {

             $imagePath = $row->image ? asset("/dashboard/images/banners/{$row->image}") : asset('/dashboard/images/missing.jpg');
                        return "<img src='{$imagePath}' width='20%'>";

                    })

                    ->editColumn('status', function ($row) {
                        $html = "<select class='banner_active " . ($row->status == 1 ? 'bg-success' : '') . " form-control status' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                        <option " . ($row->status == 1 ? 'selected' : '') . " value='1'>Active</option>
                                        <option " . ($row->status == 0 ? 'selected' : '') . " value='0'>Inactive</option>
                                    </select>";
                        return $html;
                    })
                    ->editColumn('payment', function ($row) {
                        $html =
                        "<select class='banner_payment " . ($row->payment == 1 ? 'bg-success' : '') . " form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id' disabled>
                                        <option " . ($row->payment == 1 ? 'selected' : '') . " value='1'>Success</option>
                                        <option " . ($row->payment == 0 ? 'selected' : '') . " value='0'>Pending</option>
                                    </select>";

                        return $html;
                    })
                    ->addColumn('start_date', function ($row) {
                        $html = (!empty($row->start_date)) ? $row->start_date : 'null';
                        return $html;
                    })
                    ->addColumn('end_date', function($row){
                        $html = (!empty($row->end_date)) ? $row->end_date : 'null';
                        return $html;
                    })
                    ->addColumn('action', function ($row) {
                        $html =
                                '<a title="Edit" href="#" data-bs-toggle="modal" data-bs-target="#BannerEdit" class="text-white btn btn-sm  btn-primary update_banner_form text-white m-2"
                                    data-id="' . $row->id . '" data-name="' . $row->name . '" data-banner_price="' . $row->banner_price . '"
                                    data-status="' . $row->status . '" data-position="' . $row->position . '" data-renew="' . $row->renew . '"><i class="fa fa-edit"></i></a>' .
                                '<a title="Delete"  class="text-white btn btn-sm  btn-danger delete  delete_banner" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                        return $html;
                    })

                    ->rawColumns(['image','action','status','payment','start_date','end_date','action'])
                    ->make(true);
        }





        // return view('dealer.banner.dealerownbanner', compact('banners'));
        return view('dealer.banner.dealerownbanner');


    }
    public function update(Request $request)
    {
        // return $request->all();
    if ($request->ajax()) {
        $validator = Validator::make($request->all(), [
            'up_fname' => 'required|string',
            'up_lname' => 'required|string',
            'up_email' => 'required|email',
            'up_phone' => 'required',
            'up_address' => 'required',

        ], [
            'up_fname.required' => 'First name is required',
            'up_lname.required' => 'Last name is required',
            'up_email.required' => 'Email is required',
            'up_phone.required' => 'Cell is required',
            'up_address.required' => 'Address is required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        }

        $user = User::find($request->id);

        if ($request->hasFile('up_image')) {
            $path = 'dashboard/images/users/';
            $image = $request->file('up_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            if ($user->image) {
                // Delete the old image file
                unlink(public_path($path) . $user->image);
            }

            $image->move(public_path($path), $imageName);
            $user->img = $imageName;
        }

        $user->fname = $request->up_fname;
        $user->lname = $request->up_lname;
        $user->username = $request->up_fname . ' ' . $request->up_lname;
        $user->email = $request->up_email;
        $user->adf_email = $request->up_adf_email;
        $user->phone = $request->up_phone;
        $user->address = $request->up_address;
        $user->save();

        return response()->json([
            'status' => 'success',
        ]);
    }
}


    public function delete(Request $request){
        $user = User::find($request->id);
        $user->status = 0;
        $user->save();
        Auth::logout();

        return response()->json([
            'status' => 'success'
        ]

        );
    }


    public function custom(){
        $users=User::get();
        return view ('dealer.banner.bannerform', compact('users'));
    }
    public function add(Request $request){


        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'banner_price' => 'required',
                'position' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


            ], [
                'name.required' => 'Banner name is required',
                'banner_price.required' => 'Banner package is required',
                'position.required' => 'Banner position is required',
                'image.required' => 'Banner image Required',


            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ]);
            }

            $banner= new Banner();
           if($request->hasFile('image')){
            $path = '/dashboard/images/banners/';
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($path), $imageName);
            $banner->image = $imageName;
          }
          $banner->name = $request->name;
          $banner->status = $request->status;
          $banner->start_date = '';
          $banner->end_date = '';
          $banner->renew = $request->renew;
        //   $banner->payment = $request->payment;
          $banner->position = $request->position;
          $banner->banner_price = $request->banner_price;
          $banner->user_id = Auth::id();
          $banner->save();



        return response()->json([
            'status'=>'success'
        ]);
        }

        // $request->validate([
        //     'name' => 'required|string',
        //     'banner_price' => 'required|string',
        //     'position' => 'required|email',


        // ], [
        //     'name.required' => 'Banner name is required',
        //     'banner_price.required' => 'Banner price is required',
        //     'position.required' => 'Position is required',


        // ]);

        // if ($request->fails()) {
        //     return response()->json([
        //         'error' => $request->errors(),
        //     ]);
        // }

        // $banner= new Banner();
        // if($request->hasFile('image')){
        //     $path = '/dashboard/images/banners/';
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path($path), $imageName);
        //     $banner->image = $imageName;
        //   }
        //   $banner->name = $request->name;
        //   $banner->status = $request->status;
        //   $banner->start_date = '';
        //   $banner->end_date = '';
        //   $banner->renew = $request->renew;
        // //   $banner->payment = $request->payment;
        //   $banner->position = $request->position;
        //   $banner->banner_price = $request->banner_price;
        //   $banner->user_id = Auth::id();
        //   $banner->save();
        //   return redirect('/dealer/banner');
    }

    public function bannerDelete(Request $request){
        $banner =Banner::find($request->id);

        if ($banner->image != null) {
            $path = '/dashboard/images/banners/';
            unlink(public_path($path) . $banner->image);

        }

        $banner->delete();

        return response()->json([
            'status'=>'success'
        ]);
    }

    public function edit(Request $request){



        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'up_name' => 'required|string',
                'up_banner_price' => 'required',
                'up_position' => 'required|string',
                'up_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


            ], [
                'up_name.required' => 'Banner name is required',
                'up_banner_price.required' => 'Banner price is required',
                'up_position.required' => 'Position is required',
                'up_image.required' => 'Banner image required',


            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ]);
            }

            $banner= Banner::find($request->banner_id);

        if ($request->hasFile('up_image')) {
            $path = 'dashboard/images/banners/';
            $image = $request->file('up_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            if ( $banner->image != null) {

                unlink(public_path($path) .  $banner->image);
                $image->move(public_path($path), $imageName);
                $banner->image = $imageName;
            } else {
                $banner->image =  $banner->image;
            }

        }
         $banner->name = $request->up_name;
         $banner->position = $request->up_position;
         $banner->start_date = $request->up_start_date;
         $banner->end_date = $request->up_end_date;
         $banner->payment = $request->up_payment;
         $banner->status = $request->up_status;
         $banner->user_id = Auth::id();
         $banner->renew = $request->up_renew;
         $banner->save();



        return response()->json([
            'status'=>'success'
        ]);
        }





        // $banner= Banner::find($request->banner_id);

        // if ($request->hasFile('up_image')) {
        //     $path = 'dashboard/images/banners/';
        //     $image = $request->file('up_image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();

        //     if ( $banner->image != null) {

        //         unlink(public_path($path) .  $banner->image);
        //         $image->move(public_path($path), $imageName);
        //         $banner->image = $imageName;
        //     } else {
        //         $banner->image =  $banner->image;
        //     }

        // }
        //  $banner->name = $request->up_name;
        //  $banner->position = $request->up_position;
        //  $banner->start_date = $request->up_start_date;
        //  $banner->end_date = $request->up_end_date;
        //  $banner->payment = $request->up_payment;
        //  $banner->status = $request->up_status;
        //  $banner->user_id = Auth::id();
        //  $banner->renew = $request->up_renew;
        //  $banner->save();



        // return response()->json([
        //     'status'=>'success'
        // ]);

    }


    public function bannerPaymentUpdate(Request $request){
        $banner = Banner::find($request->id);

        if($request->payment == 1){
            $banner->payment = 1; // Use a single equal sign for assignment
        } elseif($request->payment == 0){
            $banner->payment = 0; // Use a single equal sign for assignment
        }
        $banner->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function bannerStatusUpdate(Request $request){
        $banner = Banner::find($request->id);
        // return $banner;

        if($request->status == 1){
            $banner->status = 1;
        } elseif($request->status == 0){
            $banner->status = 0;
        }

        $banner->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
