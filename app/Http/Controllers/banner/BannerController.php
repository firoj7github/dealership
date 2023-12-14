<?php

namespace App\Http\Controllers\banner;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Plan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index(){
        $banners= Banner::get();
        $users=User::get();
        return view ('admin.banner.banner', compact('banners', 'users'));
    }
    public function custom(){
        $users=User::get();
        return view ('admin.banner.bannerform', compact('users'));
    }
    public function add(Request $request){




        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'position' => 'required',
            'banner_price' => 'required',
            'description' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required',
            'renew' => 'required',
            'payment' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
        ], [
            'name.required' => 'The name field is required.',
            'status.required' => 'This field is required.',
            'position.required' => 'The position field is required.',
            'banner_price.required' => 'This field is required.',
            'description.required' => 'The description field is required.',
            'start_date.required' => 'The start date field is required.',
            'end_date.required' => 'The end date field is required.',
            'renew.required' => 'The renew field is required.',
            'payment.required' => 'The payment field is required.',
            'user_id.required' => 'This field is required.',
            'image.required' => 'An image file is required.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
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
          $banner->description = $request->description;
          $banner->status = $request->status;
          $banner->start_date = $request->start_date;
          $banner->end_date = $request->end_date;
          $banner->renew = $request->renew;
          $banner->payment = $request->payment;
          $banner->position = $request->position;
          $banner->banner_price = $request->banner_price;
          $banner->user_id = $request->user_id;
          $banner->save();
          return response()->json(['status' => 'success']);
    }

    public function delete(Request $request){
        $banner =Banner::find($request->id);



        $banner->delete();

        return response()->json([
            'status'=>'success'
        ]);
    }

    public function dealerDelete(Request $request){
        $banner =Banner::find($request->id);

        // if ($banner->image != null) {
        //     $path = 'dashboard/images/banners/';
        //     unlink(public_path($path) . $banner->image);

        // }

        $banner->delete();

        return response()->json([
            'status'=>'success'
        ]);
    }

    public function permanentDelete(Request $request){
        $banner = Banner::find($request->id);

        if ($banner->image != null) {
            $path = 'dashboard/images/banners/';
            unlink(public_path($path) . $banner->image);

        }

        $banner->forceDelete();

        return response()->json([
            'status'=>'success'
        ]);
    }

    public function dealerPermanentDelete(Request $request){
        $banner = Banner::find($request->id);

        if ($banner->image != null) {
            $path = 'dashboard/images/banners/';
            unlink(public_path($path) . $banner->image);

        }

        $banner->forceDelete();

        return response()->json([
            'status'=>'success'
        ]);
    }

    public function edit(Request $request){

        $validator = Validator::make($request->all(), [
            'up_name' => 'required|string',
            'up_position' => 'required',
            'up_description' => 'required|string',
            'up_renew' => 'required',
            'up_payment' => 'required',
            'up_status' => 'required',
        ], [
            'up_name.required' => 'The name field is required.',
            'up_status.required' => 'This field is required.',
            'up_position.required' => 'The position field is required.',
            'up_description.required' => 'The description field is required.',
            'up_renew.required' => 'The renew field is required.',
            'up_payment.required' => 'The payment field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
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
         $banner->description = $request->up_description;
         $banner->user_id = $request->dealer_id;
         $banner->renew = $request->up_renew;
         $banner->save();

        return response()->json([
            'status'=>'success'
        ]);

    }
    public function paymentUpdate(Request $request){


        $banner = Banner::find($request->id);

        if($request->payment=='1'){
            $banner->payment='1';
        }elseif($request->payment=='0'){
            $banner->payment='0';
        }
        $banner->save();
        return response()->json([
            'status'=>'success'
        ]);



    }
    public function list(){
        $users= User::get();
        $plans=Plan::get();
        return view('admin.banner.bannerlist', compact('users','plans'));
    }


    public function insert(Request $request){


        $validator = Validator::make($request->all(), [
            'administrator' => 'required',
            'description' => 'required',
            'name' => 'required',
            'position' => 'required',
            'price' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ], [
            'administrator.required' => 'This field is required.',
            'description.required' => 'The description field is required.',
            'name.required' => 'The name field is required.',
            'position.required' => 'The position field is required.',
            'price.required' => 'The price field is required.',
            'user_id.required' => 'This field is required.',
            'status.required' => 'This field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

         $plan = new Plan();
         $plan->name = $request->name;
         $plan->position = $request->position;
         $plan->price = $request->price;
         $plan->description = $request->description;
         $plan->administrator_only = $request->administrator;
         $plan->status = $request->status;
         $plan->user_id = $request->user_id;
         $plan->save();
         return response()->json(['status' => 'success']);

    }
    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'up_administrator' => 'required',
            'up_description' => 'required',
            'up_name' => 'required',
            'up_position' => 'required',
            'up_price' => 'required',
            'up_user_id' => 'required',
            'up_status' => 'required',
        ], [
            'up_administrator.required' => 'This field is required.',
            'up_description.required' => 'The description field is required.',
            'up_name.required' => 'The name field is required.',
            'up_position.required' => 'The position field is required.',
            'up_price.required' => 'The price field is required.',
            'up_user_id.required' => 'This field is required.',
            'up_status.required' => 'This field is required.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $plan= Plan::find($request->plan_id);
        $plan->name = $request->up_name;
        $plan->position = $request->up_position;
        $plan->price = $request->up_price;
        $plan->description = $request->up_description;
        $plan->administrator_only = $request->up_administrator;
        $plan->status = $request->up_status;
        $plan->user_id = $request->up_user_id;
        $plan->save();
         return response()->json([
            'status'=>'success'
         ]);

    }

    public function plandelete(Request $request){
        $banner =Plan::find($request->id);
        $banner->delete();
        return response()->json(['status' => 'success', 'message' => 'Archive Successfully']);
    }

    public function plandeletePermanent(Request $request){
        $banner =Plan::find($request->id);
        $banner->forceDelete();
        return response()->json(['status' => 'success', 'message' => 'Delete Successfully']);
    }

    public function changeActiveInactive(Request $request)
    {
        try {
            $bannerActiveInactive = Banner::find($request->id);
            $bannerActiveInactive->status = $request->status === '1' ? 1 : 0;
            $bannerActiveInactive->save();
            return response()->json(['status' => 'success', 'message' => 'Status Change Successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
    public function packagePlanStatus(Request $request)
    {
        try {

            $planStatus = Plan::find($request->id);

            $planStatus->status = $request->status === '1' ? 1 : 0;
            $planStatus->save();
            return response()->json(['status' => 'success', 'message' => 'Status Change Successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
