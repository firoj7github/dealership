<?php

namespace App\Http\Controllers\slides;

use App\Http\Controllers\Controller;
use App\Interface\SliderServiceInterface;
use App\Interface\UserServiceInterface as InterfaceUserServiceInterface;
use App\Models\Plan;
use App\Models\Slide;
use App\Models\SlidesPlan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SlideController extends Controller
{
    public function __construct(protected SliderServiceInterface $sliderService, protected InterfaceUserServiceInterface $userService){

    }
    public function index(Request $request)
    {
        $slides= $this->sliderService->all();
        $users= $this->userService->all()->get();



        if ($request->ajax()) {
            return DataTables::of($slides)
                    ->addIndexColumn()
                    ->addColumn('DT_RowIndex', function ($user) {
                        return $user->id; // Use any unique identifier for your rows
                    })
                    ->addColumn('check', function ($row) {
                        $html = '';
                        $html .= '<div class="icheck-primary text-center">
                        <input type="checkbox" name="inventory_id[]" value="' . $row->id . '" class="mt-2 check1">
                        </div>';

                        return $html;
                    })
                    ->addColumn('img', function ($row) {

                        $imagePath = $row->image ? asset("/dashboard/images/slides/{$row->image}") : 'Not specified slider';
                        return "<img src='{$imagePath}' width='60px'>";
                    })

                    ->addColumn('payment', function ($row) {
                        $html = "<select class='slide_payment  " . ($row->slide_payment == 1 ? 'bg-success' : '') . " form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                    <option " . ($row->slide_payment == 1 ? 'selected' : '') . " value='1'>Suceess</option>
                                    <option " . ($row->slide_payment == 0 ? 'selected' : '') . " value='0'>Pendings</option>
                                </select>";
                        return $html;
                    })
                    ->addColumn('status', function ($row) {
                        $html = "<select class='action-select " . ($row->status == 1 ? 'bg-success' : '') . " form-control changeActiveMode' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                    <option " . ($row->status == 1 ? 'selected' : '') . " value='1'>Active</option>
                                    <option " . ($row->status == 0 ? 'selected' : '') . " value='0'>Inactive</option>
                                </select>";
                        return $html;
                    })

                    ->addColumn('action', function ($row) {
                        $html = '<a  data-bs-toggle="modal" data-bs-target="#SlideEdit" data-id="' . $row->id . '" data-title="' . $row->title . '" data-status="' . $row->status . '"
                                    data-url="' . $row->url . '" data-slide_payment="' . $row->slide_payment . '" data-slide_renew="' . $row->slide_renew . '"
                                    data-sub_title="' . $row->sub_title . '" data-slide_start_date="' . $row->slide_start_date . '" data-slide_end_date="' . $row->slide_end_date . '" data-description="' . $row->description .'" data-image="' . $row->image .'"  data-user="' . $row->user_id .'" class="btn btn-success btn-sm edit_slide_form text-white" title="Edit"><i class="fa fa-edit"></i></a>' .
                                ' <a class="btn btn-warning btn-sm delete text-white delete_slides" data-id="' . $row->id . '" href="' . route('dealer.delete', ['id' => $row->id]) . '" title="Archive"><i class="fa fa-delete-left"></i></a>' .
                                ' <a class="btn btn-danger btn-sm delete text-white permamentDelete_slides" data-id="' . $row->id . '" href="' . route('dealer.delete', ['id' => $row->id]) . '" title="Delete"><i class="fa fa-trash"></i></a>';
                        return $html;
                    })

                    ->rawColumns(['action','check','img','status','payment'])
                    ->make(true);
        }
            return view ('admin.slides.slides', compact('users'));
    }
    public function custom(){
        return view ('admin.slides.slideview');
    }
    public function insert(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'url' => 'required|url',
            'description' => 'required|string',
            'slide_start_date' => 'required',
            'slide_end_date' => 'required',
            'slide_renew' => 'required',
            'slide_payment' => 'required',
            'select_dealer' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
        ], [
            'title.required' => 'The title field is required.',
            'status.required' => 'This field is required.',
            'sub_title.required' => 'The subtitle field is required.',
            'url.required' => 'The URL field is required.',
            'url.url' => 'The URL must be a valid URL.',
            'description.required' => 'The description field is required.',
            'slide_start_date.required' => 'The start date field is required.',
            'slide_end_date.required' => 'The end date field is required.',
            'slide_renew.required' => 'The renew field is required.',
            'slide_payment.required' => 'The payment field is required.',
            'select_dealer.required' => 'The dealer selection field is required.',
            'image.required' => 'An image file is required.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
      $slide = new Slide();
      if($request->hasFile('image')){
        $path = '/dashboard/images/slides/';
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $imageName);
        $slide->image = $imageName;
      }

      $slide->title = $request->title;
      $slide->sub_title = $request->sub_title;
      $slide->url = $request->url;
      $slide->description = $request->description;
      $slide->slide_start_date = $request->slide_start_date;
      $slide->slide_end_date = $request->slide_end_date;
      $slide->slide_renew = $request->slide_renew;
      $slide->slide_payment = $request->slide_payment;
      $slide->status = $request->status;

      $slide->user_id = $request->select_dealer;
      $slide->save();
      return response()->json(['status' => 'success']);


    }
    public function update(Request $request){



        $validator = Validator::make($request->all(), [
            'up_title' => 'required|string',
            'up_sub_title' => 'required|string',
            'up_description' => 'required|string',
            'up_slide_renew' => 'required',
            'up_slide_payment' => 'required',
            'up_select_dealer' => 'required',
            'up_status' => 'required',
        ], [
            'up_title.required' => 'The title field is required.',
            'up_status.required' => 'This field is required.',
            'up_sub_title.required' => 'The subtitle field is required.',
            'up_description.required' => 'The description field is required.',

            'up_slide_renew.required' => 'The renew field is required.',
            'up_slide_payment.required' => 'The payment field is required.',
            'up_select_dealer.required' => 'The dealer selection field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $slides= Slide::find($request->slides_id);

        if ($request->hasFile('up_image')) {
            $path = 'dashboard/images/slides/';
            $image = $request->file('up_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            if ( $slides->image != null) {

                unlink(public_path($path) .  $slides->image);
                $image->move(public_path($path), $imageName);
                $slides->image = $imageName;
            } else {
                $slides->image =  $slides->image;
            }

        }
        $slides->title = $request->up_title;
        $slides->sub_title = $request->up_sub_title;
        $slides->url = $request->up_url;
        $slides->description = $request->up_description;
        $slides->slide_start_date = $request->up_slide_start_date;
        $slides->slide_end_date = $request->up_slide_end_date;
        $slides->slide_renew = $request->up_slide_renew;
        $slides->slide_payment = $request->up_slide_payment;
        $slides->status = $request->up_status;
        $slides->user_id = $request->up_select_dealer;
        $slides->save();
        return response()->json([
            'status'=>'success'
        ]);

    }

    public function delete(Request $request){

        $slides =Slide::find($request->id);

        // if ($slides->image != null) {
        //     $path = 'dashboard/images/slides/';
        //     unlink(public_path($path) . $slides->image);

        // }

        $slides->delete();

        return response()->json([
            'status'=>'success'
        ]);

    }

    public function permanentDelete(Request $request){

        $slides =Slide::find($request->id);

        if ($slides->image != null) {
            $path = 'dashboard/images/slides/';
            unlink(public_path($path) . $slides->image);

        }

        $slides->forceDelete();

        return response()->json([
            'status'=>'success'
        ]);

    }

    public function paymentManage(Request $request){


        try {
            $sliderActiveInactive = Slide::find($request->id);
            $sliderActiveInactive->slide_payment = $request->payment === '1' ? 1 : 0;
            $sliderActiveInactive->save();
            return response()->json(['status' => 'success', 'message' => 'payment Successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    public function changeActiveInactive(Request $request)
    {
        try {
            $sliderActiveInactive = Slide::find($request->id);
            $sliderActiveInactive->status = $request->status === '1' ? 1 : 0;
            $sliderActiveInactive->save();
            return response()->json(['status' => 'success', 'message' => 'Status Change Successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function planchange(Request $request)
    {
        try {
            $sliderActiveInactive = SlidesPlan::find($request->id);
            $sliderActiveInactive->status = $request->status === '1' ? 1 : 0;
            $sliderActiveInactive->save();
            return response()->json(['status' => 'success', 'message' => 'Status Change Successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function trushList(Request $request)
    {

        $slides= $this->sliderService->getTrashedItem();
        $users= $this->userService->all()->get();
       if ($request->ajax()) {
        // dd($slides);
        return DataTables::of($slides)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function ($user) {
                    return $user->id; // Use any unique identifier for your rows
                })
                ->addColumn('check', function ($row) {
                    $html = '';
                    $html .= '<div class="icheck-primary text-center">
                    <input type="checkbox" name="inventory_id[]" value="' . $row->id . '" class="mt-2 check1">
                    </div>';

                    return $html;
                })
                ->addColumn('img', function ($row) {

                    $imagePath = $row->image ? asset("/dashboard//images/slides/{$row->image}") : 'Not specified slider';
                    return "<img src='{$imagePath}' width='60px'>";
                })

                ->addColumn('payment', function ($row) {
                    $html = "<select class='slide_payment  " . ($row->slide_payment == 1 ? 'bg-success' : '') . " form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                <option " . ($row->slide_payment == 1 ? 'selected' : '') . " value='1'>Suceess</option>
                                <option " . ($row->slide_payment == 0 ? 'selected' : '') . " value='0'>Pendings</option>
                            </select>";
                    return $html;
                })
                ->addColumn('status', function ($row) {
                    $html = "<select class='action-select " . ($row->status == 1 ? 'bg-success' : '') . " form-control changeActiveMode' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                <option " . ($row->status == 1 ? 'selected' : '') . " value='1'>Active</option>
                                <option " . ($row->status == 0 ? 'selected' : '') . " value='0'>Inactive</option>
                            </select>";
                    return $html;
                })

                ->addColumn('action', function ($row) {
                    $html = '<a  data-bs-toggle="modal" data-bs-target="#SlideEdit" data-id="' . $row->id . '" data-title="' . $row->title . '" data-status="' . $row->status . '"
                                data-url="' . $row->url . '" data-slide_payment="' . $row->slide_payment . '" data-slide_renew="' . $row->slide_renew . '"
                                data-sub_title="' . $row->sub_title . '" data-slide_start_date="' . $row->slide_start_date . '" data-slide_end_date="' . $row->slide_end_date . '" data-description="' . $row->description .'" data-image="' . $row->image .'" class="btn btn-success edit_slide_form text-white">Edit</a>' .
                            '<a class="btn btn-danger delete text-white delete_slides" data-id="' . $row->id . '" href="' . route('dealer.delete', ['id' => $row->id]) . '">Delete</a>';
                    return $html;
                })


                ->rawColumns(['action','check','img','status','payment'])
                ->make(true);
    }




       return view ('admin.slides.trash-list',compact('users'));

    }


    public function sliderList(){
        $users= User::all();
        $plans=SlidesPlan::all();
        return view('admin.slides.sliderlist', compact('users','plans'));
    }

    public function slideInsert(Request $request){

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
            $plan = new SlidesPlan();
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


      public function planUpdate(Request $request){

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
        $plan= SlidesPlan::find($request->plan_id);
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

        $banner =SlidesPlan::find($request->id);
        $banner->delete();
        return response()->json(['status' => 'success', 'message' => 'delete successfully']);
    }
    public function plandeletePermanent(Request $request){

        $banner =SlidesPlan::find($request->id);
        $banner->forceDelete();
        return response()->json(['status' => 'success', 'message' => 'delete successfully']);
    }


    public function option(Request $request){
        $user = User::find($request->id);

        return $user;




    }



}
