<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MembershipType;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Interface\InventoryServiceInterface;
use App\Interface\UserServiceInterface;
use App\Mail\WelcomeEmail;
use App\Models\Banner;
use App\Models\Inventory;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\DealerInfo;
use App\Models\Invoice;
use App\Models\Membership;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DealerManagementController extends Controller
{
    public function __construct(protected UserServiceInterface $userService, protected InventoryServiceInterface $inventoryService)
    {
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = $this->userService->all()->where('role', '!=','1');
            return DataTables::of($data)
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
                ->editColumn('img', function ($row) {

                    // $image  = ($row->img != null) ? "{{ asset('/dashboard') }}/images/dealers/{{ $row->image }}" : "{{ asset('/dashboard/images/avatar.png')}}";
                    // return "<img src='$image' width='60px'>";

                    $imagePath = $row->img ? asset("/dashboard/images/dealers/{$row->img}") : asset('/dashboard/images/avatar.png');
                    return "<img src='{$imagePath}' width='60px' class='img-responsive'>";
                })

                ->editColumn('username', function ($row) {
                    $html = "<u><a href='" . route('admin.user.information', $row->id) . "'>$row->username</a></u>";
                    return $html;
                })
                ->editColumn('role', function ($row) {

                    return $row->role == 2 ? "Dealer" : "Seller";
                })

                ->addColumn('membership', function ($row) {

                    $membership_html_1 = "<select name='package' id='package_" . $row->id . "' class='packages display-select form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='" . $row->id . "'>
                        <option value='" . MembershipType::Copper->value . "' " . ($row->package == MembershipType::Copper->value ? 'selected' : '') . ">Copper</option>
                        <option value='" . MembershipType::Silver->value . "' " . ($row->package == MembershipType::Silver->value ? 'selected' : '') . ">Silver</option>
                        <option value='" . MembershipType::Gold->value . "' " . ($row->package == MembershipType::Gold->value ? 'selected' : '') . ">Gold</option>
                        <option value='" . MembershipType::Platinum->value . "' " . ($row->package == MembershipType::Platinum->value ? 'selected' : '') . ">Platinum</option>
                        <option value='" . MembershipType::Blocked->value . "' " . ($row->package == MembershipType::Blocked->value ? 'selected' : '') . ">Blocked</option>
                    </select>";

                    $membership_html_2 = "<select name='package' id='package_" . $row->id . "' class='packages display-select form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='" . $row->id . "'>
                        <option value='" . MembershipType::Standard->value . "' " . ($row->package == MembershipType::Standard->value ? 'selected' : '') . ">Standard</option>
                        <option value='" . MembershipType::Premium->value . "' " . ($row->package == MembershipType::Premium->value ? 'selected' : '') . ">Premium</option>
                        <option value='" . MembershipType::Exclusive->value . "' " . ($row->package == MembershipType::Exclusive->value ? 'selected' : '') . ">Exclusive</option>
                        <option value='" . MembershipType::Blocked->value . "' " . ($row->package == MembershipType::Blocked->value ? 'selected' : '') . ">Blocked</option>
                    </select>";

                    return $row->role == 2 ? $membership_html_1 : $membership_html_2;
                })

                ->editColumn('status', function ($row) {
                    $html = "<select class='action-select " . ($row->status == 1 ? 'bg-success' : '') . " form-control status' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                    <option " . ($row->status == 1 ? 'selected' : '') . " value='1'>Active</option>
                                    <option " . ($row->status == 0 ? 'selected' : '') . " value='0'>Inactive</option>
                                </select>";
                    return $html;
                })

                ->addColumn('action', function ($row) {
                    $html = '<a href="' . route("dealer.information", $row->id) . '" title="Inventory" class="text-white btn btn-sm  btn-success"><i class="fa fa-bus "></i></a> &nbsp;' .
                        '<a href="' . route('admin.dealer.invoice', $row->id) . '" title="Invoice" class="text-white btn btn-sm  btn-info"><i class="fa fa-file-text "></i></a> &nbsp;' .
                        '<a href="#" id="update_dealer_Form" data-bs-toggle="modal" data-bs-target="#dealerUpdateModal" data-id="' . $row->id . '" data-fname="' . $row->fname . '" data-lname="' . $row->lname . '"
                                    data-email="' . $row->email . '" data-address="' . $row->address . '" data-phone="' . $row->phone . '" data-adf_email="' . $row->adf_email . '"  data-img="' . $row->img . '"title="Edit" class="text-white btn btn-sm  btn-success"><i class="fa fa-edit "></i></a> &nbsp;' .
                        '<a  data-id="' . $row->id . '" href="' . route('admin.dealer.delete', ['id' => $row->id]) . '"  title="Archive" class="delete text-white btn btn-sm  btn-warning"><i class="fa-solid fa-xmark fw-bold"></i></a> &nbsp;' .'<a  data-id="' . $row->id . '" href="' . route('admin.dealer.permanent.delete', ['id' => $row->id]) . '" class="permanent_delete text-white btn btn-sm  btn-danger" title="Delete"><i class="fa fa-trash "></i></a> &nbsp;';
                    return $html;
                })

                // '<a class="btn btn-danger delete text-white" data-id="' . $row->id . '" href="' . route('admin.dealer.delete', ['id' => $row->id]) . '">Delete</a>';
                //     <a href="#" data-id="{{ $info->id }}" class="listing_delete text-danger">
                //     <i class="fa fa-delete-left"></i>
                // </a>
                ->rawColumns(['action', 'check', 'username', 'img', 'role', 'membership', 'status'])
                ->make(true);
        }

        return view('admin.dealer.dealer_management');
    }

    public function information($id)
    {
        // $dealer_details = User::with(['dealer_information'])->where('id',$request->id);
        // $dealer_details = User::with('inventory')->where('id',$id)->get();
        $dealer_details = Inventory::where('user_id', $id)->paginate(16);
        return view('admin.dealer.dealer_inventory_view', compact('dealer_details'));
    }


    public function create(Request $request)
    {




        $validator = Validator::make($request->all(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:users',
            // 'adf_email' => 'nullable',
            // 'address' => 'nullable',
            // 'phone' => 'nullable',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ],[
            'fname.required' => 'The first name field is required.',
            'lname.required' => 'The last name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email address is already in use.',
            'confirm_password.same' => 'The confirm password must match the password.',
            'password.required' => 'The password field is required.',
            'confirm_password.required' => 'The confirm password field is required.',
            'password.min' => 'The password must be at least :min characters.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $dealer = $this->userService->store($request->all());
        if($dealer)
        {
            $data =[
                'id' => $dealer->id,
                'name'=> $dealer->username,
            ];
                Mail::to($request->email)->send(new WelcomeEmail($data));
        }

        return response()->json(['status' => 'success']);

    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'up_fname' => 'required|string',
            'up_lname' => 'required|string',
            'up_email' => 'required|email',
        ],[
            'up_fname.required' => 'The first name field is required.',
            'up_lname.required' => 'The last name field is required.',
            'up_email.required' => 'The email is required.',
            'up_email.email' => 'The email must be valid email ',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        // Now $validatedData is an array containing the validated data
        $this->userService->updateUser($request->all());
        return response()->json(['status' => 'success']);
    }

    public function delete($id)
    {
        $this->userService->trash($id);
        return response()->json(['status' => 'User deleted successfully !'], 200);
    }

    public function Permanentdelete($id)
    {
        // $this->userService->trash($id);
        $this->userService->permanentDelete($id);
        return response()->json(['status' => 'User deleted successfully !'], 200);
    }



    public function userInformation($id)
    {


        $user = User::find($id);
        return view('admin.dealer.dealer_all_information', compact('user'));
    }



//     @foreach ($inventories as $inventory)
//     <tr>
//         <td>
//             <input type="checkbox"
//                 class="check-row"
//                 data-id="{{ $inventory->id }}">
//         </td>
//         <td>
//             <a href="#" class="toggle-details"><i
//                     class="fa-solid fa-circle-plus"></i></a>
//             @php
//                 $cars = $inventory->image_from_url;
//                 $total_cars = explode(',', $cars);
//                 $final_car = $total_cars[0];

//             @endphp


//         </td>



//         <td class="fs-6">
//             {{ $inventory->stock }}</td>
//         <td style="font-size:10px; font-weight:bold; opacity:97%">
//             {{ $inventory->title }}</td>
//         <td style="font-size:10px; font-weight:bold; opacity:97%">
//             Skco Automotive</td>
//         <td style="font-size:10px; font-weight:bold; opacity:97%">
//             {{ $inventory->make }}/{{ $inventory->model }}
//         </td>
//         <td style="font-size:10px; font-weight:bold; opacity:97%">
//             {{ $inventory->payment_date ? Carbon\Carbon::parse($inventory->payment_date)->format('m-d-Y') : 'Null' }}
//         </td>

//         {{-- @php
//                 $carbonDate_active = \Carbon\Carbon::parse($inventory->active_till);
//                 $carbonDate_featured = \Carbon\Carbon::parse($inventory->featured_till);

//                 // Format the date as 'm-d-Y'
//                 $active_till = $carbonDate_active->format('m-d-Y');
//                 $featured_till = $carbonDate_featured->format('m-d-Y');
//             @endphp --}}
//         <td style="font-size:10px; font-weight:bold; opacity:97%" id="active_till">

//             {{ $inventory->active_till ? Carbon\Carbon::parse($inventory->active_till)->format('m-d-Y') : 'Null' }}
//         </td>
//         <td style="font-size:10px; font-weight:bold; opacity:97%" id="feature_till">
//             {{ $inventory->featured_till ? Carbon\Carbon::parse($inventory->featured_till)->format('m-d-Y') : 'Null' }}
//         </td>
//         @php
//             $activeValue = App\Enums\VisibilityStatusOrInventoryStatus::Active->value;
//             $inactiveValue = App\Enums\VisibilityStatusOrInventoryStatus::Inactive->value;
//             $archiveValue = App\Enums\VisibilityStatusOrInventoryStatus::Archived->value;
//             $ExpireValue = App\Enums\VisibilityStatusOrInventoryStatus::Expired->value;
//             $invalidValue = App\Enums\VisibilityStatusOrInventoryStatus::Invalid->value;
//             $blockedValue = App\Enums\VisibilityStatusOrInventoryStatus::Blocked->value;

//             $standardeListingPlanorpackageStatus = App\Enums\ListingPlanOrPackageType::Standard->value;
//             // $featuredListingPlanorpackageStatus = App\Enums\ListingPlanOrPackageType::Feature->value;
//         @endphp

//         <td>
//             {{-- <select
//                 class="status-select form-control {{ $inventory->package == $featuredListingPlanorpackageStatus ? 'bg-warning' : '' }}"
//                 style="font-size:10px; font-weight:bold; opacity:97%" name="package"
//                 data-id="{{ $inventory->id }}" disabled>
//                 <option value="{{ $standardeListingPlanorpackageStatus }}"
//                     {{ $inventory->package == $standardeListingPlanorpackageStatus ? 'selected' : '' }}>
//                     Standard Package</option>
//                 {{-- <option value="{{ $featuredListingPlanorpackageStatus }}"
//                     {{ $inventory->package == $featuredListingPlanorpackageStatus ? 'selected' : '' }}>
//                     Featured Package
//                 </option> --}}

//            {{-- </select> --}}
//            @php
//            switch ($user->package) {
//             case App\Enums\MembershipType::Copper->value == $user->package:
//                     $result = App\Enums\MembershipType::Copper->name;
//                 break;

//             case App\Enums\MembershipType::Standard->value == $user->package:
//                     $result = App\Enums\MembershipType::Standard->name;
//                 break;
//             case App\Enums\MembershipType::Silver->value == $user->package:
//                     $result = App\Enums\MembershipType::Silver->name;
//                 break;
//             case App\Enums\MembershipType::Gold->value == $user->package:
//                     $result = App\Enums\MembershipType::Gold->name;
//                 break;
//             case App\Enums\MembershipType::Platinum->value == $user->package:
//                     $result = App\Enums\MembershipType::Platinum->name;
//                 break;
//             case App\Enums\MembershipType::Premium->value == $user->package:
//                     $result = App\Enums\MembershipType::Premium->name;
//                 break;
//             case App\Enums\MembershipType::Exclusive->value == $user->package:
//                     $result = App\Enums\MembershipType::Exclusive->name;
//                 break;

//             default:
//                 $result = App\Enums\MembershipType::Blocked->name;
//                 break;
//            }
//            @endphp

//            {{  $result }}

//         </td>
//         <td>
//             <select
//                 class="display-select
//                 @if ($inventory->is_visibility == $activeValue) {{ 'bg-success text-white' }}
//                 @elseif($inventory->is_visibility == $inactiveValue) {{ 'bg-light' }}
//                 @elseif($inventory->is_visibility == $archiveValue) {{ 'bg-inventory text-white' }}
//                 @elseif($inventory->is_visibility == $ExpireValue) {{ 'bg-dark text-white' }}
//                 @elseif($inventory->is_visibility == $invalidValue) {{ 'bg-warning text-white' }}
//                 @else($inventory->is_visibility == $blockedValue) {{ 'bg-danger text-white' }} @endif form-control "
//                 style="font-size:10px; font-weight:bold; opacity:97%"
//                 data-id="{{ $inventory->id }}">
//                 >

//                 <option
//                     {{ $inventory->is_visibility == $activeValue ? 'selected' : '' }}
//                     value="{{ $activeValue }}">
//                     Active
//                 </option>
//                 <option
//                     {{ $inventory->is_visibility == $inactiveValue ? 'selected' : '' }}
//                     value="{{ $inactiveValue }}">
//                     Inactive</option>
//                 <option
//                     {{ $inventory->is_visibility == $ExpireValue ? 'selected' : '' }}
//                     value="{{ $ExpireValue }}">
//                     Expired</option>
//                 <option
//                     {{ $inventory->is_visibility == $archiveValue ? 'selected' : '' }}
//                     value="{{ $archiveValue }}">
//                     Archived</option>
//                 <option
//                     {{ $inventory->is_visibility == $invalidValue ? 'selected' : '' }}
//                     value="{{ $invalidValue }}">
//                     Invalid</option>
//                 <option
//                     {{ $inventory->is_visibility == $blockedValue ? 'selected' : '' }}
//                     value="{{ $blockedValue }}">
//                     Blocked</option>

//             </select>
//         </td>

//         <td>

//             <a href="{{ route('img.show', $inventory->id) }}"
//                 class="text-secondary"><i class="fa fa-image"></i>
//             </a>
//             <a href="{{ route('listing.show', $inventory->id) }}"
//                 class="text-inventory"><i class="fa fa-eye"></i>
//             </a>
//             <a href="{{ route('listing.edit', $inventory->id) }}"
//                 class="edit_news_form text-inventory"><i class="fa fa-edit"></i>
//             </a>


//             <a href="#" data-id="{{ $inventory->id }}"
//                 class="listing_delete text-danger">
//                 <i class="fa fa-delete-left"></i>
//             </a>
//         </td>


//     </tr>

//     <tr class="details-row">

//         <td colspan="11">
//             <div class="row">
//                 <div class="col-lg-6">
//                     <div class="row">
//                         <div class="col-lg-6">
//                             <img alt="Local Cars" src="{{ $final_car }}"
//                                 class="card-image rounded" width="100%"
//                                 height="220px">
//                         </div>
//                         <div class="col-lg-6">
//                             <p class="mt-2">
//                                 Title :
//                                 <span
//                                     style="font-weight:500;">{{ $inventory->title }}</span>
//                             </p>
//                             <p class="mt-2">
//                                 Price :
//                                 <span
//                                     style="font-weight:500;">{{ $inventory->price_formate }}</span>
//                             </p>
//                             <p class="mt-2">
//                                 Engine :
//                                 <span
//                                     style="font-weight:500;">{{ $inventory->engine_description_formate }}</span>
//                             </p>

//                             <p class="mt-2">
//                                 Drive Train
//                                 : <span
//                                     style="font-weight:500;">{{ $inventory->drive_train }}</span>
//                             </p>
//                             <p class="mt-2">
//                                 Exterior
//                                 Color :
//                                 <span
//                                     style="font-weight:500;">{{ $inventory->exterior_color }}</span>
//                             </p>
//                         </div>
//                     </div>
//                 </div>
//             </div>


//         </td>


//     </tr>
// @endforeach

    public function userListing(Request $request,$id)
    {
        $inventories_object = Inventory::query();
        $inventories = $inventories_object->with('user')->where('user_id', $id)->paginate(20);
        $user = $inventories->first()->user ?? null;

        // if ($inventories_object->with('user')->where('user_id', $id)->get()->isEmpty()) {
        //     return back()->with('error', 'No inventories found for the specified user.');
        // }

        // // $invoices = Invoice::with('inventory')->latest()->get();
        if ($request->ajax()) {
            $data = $this->inventoryService->all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('check', function ($row) {
                        $html = '';
                        $html .= '<div class="icheck-primary  text-center">
                        <input type="checkbox" name="inventory_id[]" value="' . $row->id . '" class="mt-2 check1  check-row" data-id="'. $row->id .'">
                        </div>';

                        return $html;
                    })
                    ->addColumn('plus', function ($row) {
                        return  "<a href='#' class='toggle-details'><i
                        class='fa-solid fa-circle-plus'></i></a>"; // Use plus for collapse
                    })
                    ->addColumn('title', function ($row) {
                        return  substr($row->title,0,20);
                    })
                    ->addColumn('dealer', function ($row) {
                        return  $row->user->username;
                    })
                    ->addColumn('category', function ($row) {
                        return  $row->make.'/'.$row->model;
                    })
                    ->addColumn('active_start', function ($row) {
                        return  $row->stock_date_formated ? Carbon::parse($row->stock_date_formated)->format('m-d-Y') : 'null';
                    })
                    ->addColumn('active_end', function ($row) {
                        return  $row->stock_date_formated ? Carbon::parse($row->stock_date_formated)->addDays(30)->format('m-d-Y') : 'null';
                    })
                    ->addColumn('active_till', function ($row) {
                        return  $row->active_till ? Carbon::parse($row->active_till)->format('m-d-Y') : 'null';
                    })
                    ->addColumn('featured_till', function ($row) {
                        return  $row->featured_till ? Carbon::parse($row->featured_till)->addDays(30)->format('m-d-Y') : 'null';
                    })
                    ->addColumn('payment', function ($row) {
                        return  $row->payment_date ? Carbon::parse($row->payment_date)->format('m-d-Y') : 'null';
                    })
                    ->addColumn('package', function ($row) {
                        // dd(MembershipType::Copper->value);
                        if( $row->user->package == MembershipType::Standard->value)
                        {
                            $result = 'text-success';
                            $data = 'Standard';
                        }
                        elseif($row->user->package == MembershipType::Copper->value)
                        {
                            $result = 'text-info';
                            $data = 'Copper';
                        }
                        elseif($row->user->package == MembershipType::Silver->value)
                        {
                            $result = 'text-primary';
                            $data = 'Silver';
                        }
                        elseif($row->user->package == MembershipType::Gold->value)
                        {
                            $result = 'text-dark';
                            $data = 'Gold';
                        }
                        elseif($row->user->package == MembershipType::Platinum->value)
                        {
                            $result = 'text-warning';
                            $data = 'Platinum';
                        }
                        else
                        {
                            $result = 'text-danger';
                            $data = 'Blocked';
                        }
                        $html = "<span class='".$result."'>".$data."</span>";
                        return  $html;
                    })
                    ->addColumn('status', function ($row) {

                        $html = "<select class='action-add" . ($row->is_visibility == 1 ? ' bg-success' : '') . " form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                    <option " . ($row->is_visibility == 1 ? 'selected' : '') . " value='1'>Active</option>
                                    <option " . ($row->is_visibility == 0 ? 'selected' : '') . " value='0'>Inactive</option>
                                </select>";
                        return $html;
                    })

                    ->addColumn('action', function ($row) {

                        $html = '<a href="'. route('img.show', $row->id) .'" class="text-white btn btn-sm  btn-success" title="All Picture"><i class="fa fa-image"></i> </a> &nbsp;'.
                                 '<a href="'. route('listing.show', $row->id) .'" class=" btn btn-sm text-white btn-info"  title="View"><i class="fa fa-eye"></i> </a> &nbsp;'.
                                 '<a href="'. route('listing.edit', $row->id) .'" class=" btn btn-sm edit_news_form text-white btn-info"  title="Edit"><i class="fa fa-edit"></i> </a> &nbsp;'.
                                 '<a href="#" data-id="'.$row->id.'" class="btn btn-sm listing_delete text-white btn-warning"  title="Archive"> <i class="fa fa-delete-left"></i> </a> &nbsp;'.
                                 '<a href="#" data-id="'.$row->id.'" class="btn btn-sm listing_permanent_delete text-white btn-danger"  title="Delete"> <i class="fa fa-trash"></i> </a> &nbsp;';
                        return $html;
                    })


                    ->rawColumns(['plus','action','check','status','package'])
                    ->make(true);
        }
        return view('admin.dealer.listing_dealer',compact('user'));
        // return view('admin.dealer.listing_dealer', [
        //     'inventories' => $inventories,
        //     'user' => $inventories->first()->user ?? null, // Assuming a user is associated with at least one inventory
        // ]);
    }

    public function editAccount($id)
    {
        $user = User::find($id);
        return view('admin.dealer.account_edit', compact('user'));
    }

    public function updateAccount(Request $request, $id)
    {
        // return $request->file('img');
        $request->validate([

            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'account_type' => 'required',
            'status' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($id);
        if ($request->hasFile('img')) {
            $user->img = userImageUpload($request->file('img'));
        }


        $user->company_name = $request->company_name;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->username =  $request->fname .' '. $request->lname;
        $user->phone = $request->phone;
        $user->role = $request->account_type;
        $user->status = $request->status;
        $user->email = $request->email;
        $user->adf_email = $request->adf_email;
        $user->website = $request->website;
        $user->address = $request->address;
        $user->zip_code = $request->zip_code;
        $user->save();
        return redirect()->back()->with('message', 'User Account Update Successfully!');
    }

    public function changePassword(Request $request)
    {


        $validator = Validator()->make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:new_password',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }
        $user = User::find($request->user_id);


        // Check if the old password matches
        if (!Hash::check($request->current_password, $user->password)) {

            return response()->json(['status' => false, 'old_password' => 'The old password is incorrect.']);
        }

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);
        return response()->json(['status' => 'success', 'message' => 'Password Change Successfully!']);
    }


    public function userBanner($id)
    {
        $banner_object = Banner::query();
        $banners = $banner_object->with('user')->where('user_id', $id)->paginate(10);
        // $invoices = Invoice::with('inventory')->latest()->get();

        if ($banner_object->with('user')->where('user_id', $id)->get()->isEmpty()) {
            return back()->with('error', 'No banners found for the specified user.');
        }

        return view('admin.dealer.banners_dealer', [
            'banners' => $banners,
            'user' => $banners->first()->user ?? null, // Assuming a user is associated with at least one inventory
        ]);
    }

    public function userSlider($id)
    {
        $slider_object = Slide::query();
        $sliders = $slider_object->with('user')->where('user_id', $id)->paginate(10);

        if ($slider_object->with('user')->where('user_id', $id)->get()->isEmpty()) {
            return back()->with('error', 'No sliders found for the specified user.');
        }


        // $invoices = Invoice::with('inventory')->latest()->get();

        return view('admin.dealer.sliders_dealer', [
            'sliders' => $sliders,
            'user' => $sliders->first()->user ?? null, // Assuming a user is associated with at least one inventory
        ]);
    }

    public function dealarManageAjax(Request $request)
    {
        switch ($request->package) {
            case MembershipType::Copper->value == $request->package:
                $result = MembershipType::Copper->name;
                break;
            case MembershipType::Silver->value == $request->package:
                $result = MembershipType::Silver->name;
                break;
            case MembershipType::Gold->value == $request->package:
                $result = MembershipType::Gold->name;
                break;
            case MembershipType::Platinum->value == $request->package:
                $result = MembershipType::Platinum->name;
                break;
            case MembershipType::Premium->value == $request->package:
                $result = MembershipType::Premium->name;
                break;
            case MembershipType::Exclusive->value == $request->package:
                $result = MembershipType::Exclusive->name;
                break;
            case MembershipType::Blocked->value == $request->package:
                $result = MembershipType::Blocked->name;
                break;
            default:
                $result = MembershipType::Standard->name;
        }

        $user = $this->userService->find($request->id);
        $user->package = $request->package;
        $user->save();

        $inventories = $this->inventoryService->getByUserId($request->id);

            foreach ($inventories as $inventory) {
                if ($inventory->user->package == MembershipType::Blocked->value) {
                    return response()->json(['status' => 'Membership Blocked successfully!'], 200);
                } else {
                    if ($user->role != 0) {
                        if ($user->package != MembershipType::Copper->value) {
                            // dd($inventory); // Debugging line, remove or comment out after use
                            $inventory->package = $user->package;
                            $inventory->is_feature = 1;
                        } else {
                            $inventory->package = $user->package;
                            $inventory->is_feature = 0;
                        }
                        $inventory->save();
                        // return response()->json(['status' => 'Update successfully & unfeature!'], 200);
                    } else {
                        // return response()->json(['status' => 'Your role is not suitable for this!'], 200);
                    }
                }
            }



        return response()->json(['status' => 'Membership updated ' . $result . ' successfully!'], 200);
    }

    public function dealarManageActiveAjax(Request $request)
    {
        $user = $this->userService->find($request->id);
        $user->status = $request->status;
        $user->save();
        ($request->status == 1) ? $result = 'Active' : $result = "Inactive";
        return response()->json(['status' => 'Membership ' . $result . ' successfully!'], 200);
    }
}
