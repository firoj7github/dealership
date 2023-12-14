<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interface\LeadServiceInterface;
use App\Mail\AdminLeadSendMail;
use App\Models\AdminContactDealer;
use App\Models\Lead;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class AdminLeadController extends Controller
{
    public function __construct(protected LeadServiceInterface $leadService)
    {

    }

    public function index(Request $request)
    {
        $leads = $this->leadService->all();
        if ($request->ajax()) {
            return DataTables::of($leads)
                    ->addIndexColumn()
                    ->addColumn('DT_RowIndex', function ($user) {
                        return $user->id; // Use any unique identifier for your rows
                    })
                    ->addColumn('check', function ($row) {
                        $html = '';
                        $html .= '<div class="icheck-primary text-center">
                        <input type="checkbox" name="lead_id[]" value="' . $row->id . '" class="mt-2 check1">
                        </div>';
                        return $html;
                    })

                    ->addColumn('stock', function ($row) {
                        return $row->inventories_car->stock ?? 'Not specific stock';
                    })
                    ->addColumn('title', function ($row) {
                        return substr($row->inventories_car->title,0,30) ?? 'Not specific title';
                    })
                    ->addColumn('dealer', function ($row) {
                        return $row->inventories_car->users->username ?? 'Not specific dealer';
                    })
                    ->addColumn('package', function ($row) {
                        if($row->inventories_car->package == 0)
                        {
                            $result = '<p clas="">Standard</p>';
                        }
                        elseif($row->inventories_car->package == 1)
                        {
                            $result = '<p clas="">Copper</p>';
                        }
                        elseif($row->inventories_car->package == 2)
                        {
                            $result = '<p clas="">Silver</p>';
                        }
                        elseif($row->inventories_car->package == 3)
                        {
                            $result = '<p clas="">Gold</p>';
                        }
                        elseif($row->inventories_car->package == 4)
                        {
                            $result = '<p clas="">Plutinum</p>';
                        }else{
                            $result = '<p clas="">Blocked</p>';
                        }
                        return $result;
                    })
                    ->editColumn('role', function ($row) {

                        return $row->role == 2 ? "Dealer" : "Seller";

                    })
                    ->addColumn('membership', function ($row) {

                    $membership_html_1 = "<select name='package' id='' class='packages display-select form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='{{ $row->id }}'>
                    <option value='1'>Copper</option>
                    <option value='2'>Silver</option>
                    <option value='4'>Gold</option>
                    <option value='5'>Platinum</option>
                    <option value='6'>Blocked</option>
                 </select>";
                    $membership_html_2 = "<select name='package' id='' class='packages display-select form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='{{ $row->id }}'>
                       <option value='0'>Standard</option>
                       <option value='1'>Premium</option>
                       <option value='2'>Exclusive</option>
                       <option value='5'>Blocked</option>
                 </select>";

                        return $row->role == 2 ? $membership_html_1 : $membership_html_2;

                    })
                    ->addColumn('sta',function($row){
                        return $row->is_admin_read;
                    })
                    ->editColumn('status', function ($row) {
                        $html = "<select class='action-select " . ($row->status == 1 ? 'bg-success' : '') . " form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                    <option " . ($row->status == 1 ? 'selected' : '') . " value='active'>Active</option>
                                    <option " . ($row->status == 0 ? 'selected' : '') . " value='inactive'>Inactive</option>
                                </select>";
                        return $html;
                    })

                    ->addColumn('view', function ($row) {
                         $html = '<a href="javascript:void(0)" class="btn btn-info shadow" onclick="modalShow('. $row->id  .')">View / Reply</a>';
                        return $html;
                    })
                    ->addColumn('cus_name', function ($row) {
                        return $row->user->username;
                    })
                    ->addColumn('cus_phone', function ($row) {
                        return $row->user->phone;
                    })
                    ->addColumn('cus_email', function ($row) {
                        return $row->user->email;
                    })
                    ->addColumn('category', function ($row) {
                        return $row->inventories_car->category;
                    })
                    ->addColumn('listing', function ($row) {
                        $html = ($row->is_feature == 1) ? "Featured" : "Free";
                        return $html;
                    })
                    ->addColumn('action', function ($row) {
                        $html = '<a href="'. route('admin.view.lead',$row->id).'" class="btn btn-sm btn-success" title="view"><i class="fa fa-eye"></i></a> &nbsp;'.
                                '<a href="#" class="btn btn-sm btn-info contact_dealer" title="contact dealer" data-id="'.$row->id.'" data-name="'.$row->inventories_car->users->username.'" data-email="'.$row->inventories_car->users->email.'" data-phone="'.$row->inventories_car->users->phone.'"><i class="fa-regular fa-address-card"></i></a>

                                <a href="#" class="btn btn-sm btn-info send_email" title="Send Email" data-id="'.$row->id.'" data-name="'.$row->inventories_car->users->username.'" data-email="'.$row->inventories_car->users->email.'" data-phone="'.$row->inventories_car->users->phone.'"><i class="fa-solid fa-envelope"></i></a>
                                &nbsp;<a href="#" class="btn btn-sm btn-primary adfLead" title="Send ADF Mail" data-id="'.$row->id.'"data-inventory="'.$row->inventory_id.'"data-customer="'.$row->user_id.'"><i class="fa fa-paper-plane"></i></a>
                                &nbsp;<a href="#" class="btn btn-sm btn-warning deleteLead" title="Archive" data-id="'.$row->id.'"><i class="fa fa-delete-left"></i></a>
                                &nbsp;<a href="#" class="btn btn-sm btn-danger permanentDeleteLead" title="delete" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                        return $html;
                    })
                    ->addColumn('stage', function ($row) {
                        if($row->stage == 0)
                            {
                                $result = '<p clas="">Pending</p>';
                            }
                            elseif($row->stage == 1)
                            {
                                $result = '<p clas="">Working</p>';
                            }
                            elseif($row->stage == 2)
                            {
                                $result = '<p clas="">Completed</p>';
                            }
                            else
                            {
                                $result = '<p clas="">Blocked</p>';
                            }
                        return $result;
                    })


                    ->rawColumns(['action','check','status','package','view','stage'])
                    ->make(true);
        }
        return view('admin.lead.index',compact('leads'));

    }



    public function viewLead($id)
    {
        $lead = $this->leadService->find($id);
        $lead->is_admin_read = 1;
        $lead->save();

        return view('admin.lead.view-lead',compact('lead'));
    }

    public function sendLeadContact(Request $request)
    {

        $contact_dealer = new AdminContactDealer();
        $contact_dealer->user_id = Auth::id();
        $contact_dealer->lead_id = $request->lead_id;
        $contact_dealer->message = $request->message;
        $contact_dealer->save();
        return redirect()->back()->with('message','message sent successfully');
    }


    public function indivisualDealerLead($id)
    {
        return view('admin.dealer.lead');
    }


    public function deleteLead(Request $request)
    {
      try
      {
        $delete_lead = Lead::find($request->id);
        $delete_lead->delete();
        return response()->json(['status'=>'success','message'=>'Archived Successfully!']);

      }catch(Exception $e)
      {
        return response()->json(['error' => $e->getMessage()], 500);

      }

    }

    public function permanentDeleteLead(Request $request)
    {
      try
      {
        $delete_lead = Lead::find($request->id);
        $delete_lead->forceDelete();
        return response()->json(['status'=>'success','message'=>'Delete Successfully!']);

      }catch(Exception $e)
      {
        return response()->json(['error' => $e->getMessage()], 500);

      }

    }


    public function send(Request $request)
    {
        try
        {
            $lead_details = Lead::with('inventories_car')->find($request->id);
            $customer_name = $lead_details->user->username;
            $customer_first_name = $lead_details->user->fname;
            $customer_email = $lead_details->user->email;
            $email = $lead_details->inventories_car->user->email;
            $phone = $lead_details->user->phone;
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

            $email_message = $request->message;
            $data = [
                'customer_name'     => $customer_name,
                'phone'     => $phone,
                'year'          => [$year,$tradeInYear],
                'make'          => [$make,$tradeInMake],
                'model'          => [$model,$tradeInModel],
                'price'             => $price,
                'stock'             => $stock,
                'miles'             => [$miles,$tradeInMiles],
                'vin'             => $tradeInVin,
                'color'             => [$ext_color_generic,$tradeInColor],
                'email_message'     => $email_message,
                'image'     => $image[0],
                'customer_first_name' => $customer_first_name,
                'customer_email' => $customer_email,
            ];


            Mail::to($email)->send(new AdminLeadSendMail($data));

          return response()->json(['status'=>'success','message'=>'Lead Sent Successfully!']);

        }catch(Exception $e)
        {
          return response()->json(['error' => $e->getMessage()], 500);

        }

    }



}
