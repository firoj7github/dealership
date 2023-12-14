<?php

namespace App\Http\Controllers\Dealer;

use App\Enums\ActiveInactive;
use App\Enums\MembershipType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\EmailLeadSMS;
use App\Interface\InventoryServiceInterface;
use App\Interface\LeadServiceInterface;
use App\Mail\ConfirmPassword;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Lead;
use App\Models\LeadMessage;
use App\Models\Sale;
use App\Models\Tmp_inventory;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DealerLeadController extends Controller
{
    private $inventoryService;
    private $leadService;
    public function __construct(InventoryServiceInterface $inventoryService, LeadServiceInterface $leadService)
    {
        $this->inventoryService = $inventoryService;
        $this->leadService = $leadService;
    }

    public function index(Request $request)

    {


        $cars = $this->inventoryService->all()->select(['id', 'year', 'make', 'model', 'trim', 'price', 'stock', 'image_from_url',])->get();
        $makes = $cars->pluck('id','make');
        // dd($make);
        $leads = Lead::with(['tmp_inventories_car', 'user'])->orderBy('id', 'desc')->get();
        $salesmans = Sale::all();

        $lead_data = $this->leadService->getItemByFilter($request);
        if ($request->ajax()) {
            return DataTables::of($lead_data)
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
                    return substr($row->inventories_car->title, 0, 30) ?? 'Not specific title';
                })
                ->addColumn('package', function ($row) {
                    if ($row->inventories_car->user->package == MembershipType::Standard->value) {
                        $result = '<p clas="">Standard</p>';
                    } elseif ($row->inventories_car->user->package == MembershipType::Copper->value) {
                        $result = '<p clas="">Copper</p>';
                    } elseif ($row->inventories_car->user->package == MembershipType::Silver->value) {
                        $result = '<p clas="">Silver</p>';
                    } elseif ($row->inventories_car->user->package == MembershipType::Gold->value) {
                        $result = '<p clas="">Gold</p>';
                    } elseif ($row->inventories_car->user->package == MembershipType::Platinum->value) {
                        $result = '<p clas="">Plutinum</p>';
                    } else {
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
                ->addColumn('sta', function ($row) {
                    return $row->status;
                })
                ->editColumn('status', function ($row) {
                    $html = "<select class='action-select " . ($row->status == 1 ? 'bg-success' : '') . " form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                    <option " . ($row->status == 1 ? 'selected' : '') . " value='active'>Active</option>
                                    <option " . ($row->status == 0 ? 'selected' : '') . " value='inactive'>Inactive</option>
                                </select>";
                    return $html;
                })

                ->addColumn('view', function ($row) {
                    // $html = '<a href="' . route("dealer.information", $row->id) . '" class="btn btn-warning">Inventory</a>' .
                    //         '<a href="' . route('dealer.invoice-list', $row->id) . '" class="btn btn-primary text-white">Invoice</a>' .
                    //         '<a href="#" data-bs-toggle="modal" data-bs-target="#dealerUpdateModal" class="btn btn-success update_dealer_form text-white"
                    //             data-id="' . $row->id . '" data-fname="' . $row->fname . '" data-lname="' . $row->lname . '"
                    //             data-email="' . $row->email . '" data-address="' . $row->address . '" data-phone="' . $row->phone . '">Edit</a>' .
                    //         '<a class="btn btn-danger delete text-white" data-id="' . $row->id . '" href="' . route('admin.dealer.delete', ['id' => $row->id]) . '">Delete</a>';

                    $html = '<a href="javascript:void(0)" class="btn btn-info shadow" onclick="modalShow(' . $row->id  . ')" >View / Reply</a>';
                    return $html;
                })
                ->addColumn('cus_name', function ($row) {
                    if($row->inventories_car->user->package != MembershipType::Copper->value &&  $row->inventories_car->is_feature == ActiveInactive::Active->value){
                        $html = $row->user->username;
                    }else{
                        ($row->inventories_car->user->package == MembershipType::Copper->value &&  $row->inventories_car->is_feature == ActiveInactive::Active->value) ? $html = $html = $row->user->username :  $html = '[ Purchase/upgrade ]';
                    }
                    return $html;
                })
                ->addColumn('cus_phone', function ($row) {
                    if($row->inventories_car->user->package != MembershipType::Copper->value &&  $row->inventories_car->is_feature == ActiveInactive::Active->value){
                        $html = $row->user->phone;
                    }else{
                        ($row->inventories_car->user->package == MembershipType::Copper->value &&  $row->inventories_car->is_feature == ActiveInactive::Active->value) ? $html = $html = $row->user->phone :  $html = '[ Purchase/upgrade ]';
                    }
                    return $html;
                })
                ->addColumn('cus_email', function ($row) {
                    if($row->inventories_car->user->package != MembershipType::Copper->value &&  $row->inventories_car->is_feature == ActiveInactive::Active->value){
                        $html = $row->user->email;
                    }else{
                        ($row->inventories_car->user->package == MembershipType::Copper->value &&  $row->inventories_car->is_feature == ActiveInactive::Active->value) ? $html = $html = $row->user->email :  $html = '[ Purchase/upgrade ]';
                    }
                    return $html;
                })
                ->addColumn('category', function ($row) {
                    return $row->inventories_car->category;
                })
                ->addColumn('listing', function ($row) {
                    // dd($row->inventories_car->is_feature);
                    if($row->inventories_car->user->package != MembershipType::Copper->value &&  $row->inventories_car->is_feature == ActiveInactive::Active->value){
                        $html = "Featured" ;
                    }else{
                        // dd($row->inventories_car->is_feature);
                        ($row->inventories_car->user->package == MembershipType::Copper->value &&  $row->inventories_car->is_feature == ActiveInactive::Active->value) ? $html = "Featured" : $html = "Standard";
                    }
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    // dd($row->inventories_car->is_feature == ActiveInactive::Inactive->value);
                    if($row->inventories_car->user->package != MembershipType::Copper->value &&  $row->inventories_car->is_feature == ActiveInactive::Active->value){

                        $html = '<a title="View/Reply" href="javascript:void(0)" class="text-white btn btn-sm  btn-info shadow m-2" onclick="modalShow(' . $row->id  . ')"><i class="fa fa-eye"></i></a>';
                    }else{
                        ($row->inventories_car->user->package == MembershipType::Copper->value &&  $row->inventories_car->is_feature == ActiveInactive::Active->value) ?  $html = '<a href="javascript:void(0)"  class="btn btn-info shadow" onclick="modalShow(' . $row->id  . ')"><i class="fa fa-eye"></i></a>' : $html = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#purchase" class="btn btn-dark" >Purchase</a>';;
                    }
                    $html.=       ' <a title="Delete" href="javascript:void(0)" class="text-white btn btn-sm  btn-danger lead_delete" data-id ="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                    return $html;
                })
                ->addColumn('stage', function ($row) {
                    if ($row->stage == 0) {
                        $result = '<p clas="">Pending</p>';
                    } elseif ($row->stage == 1) {
                        $result = '<p clas="">Working</p>';
                    } elseif ($row->stage == 2) {
                        $result = '<p clas="">Completed</p>';
                    } else {
                        $result = '<p clas="">Blocked</p>';
                    }
                    return $result;
                })


                ->rawColumns(['action', 'check', 'status', 'package', 'view', 'stage'])
                ->make(true);
        }



        $messages = LeadMessage::where('receiver_id', Auth::id())->orwhere('sender_id', Auth::id())->get();








        return view('dealer.lead.lead', compact('cars', 'salesmans', 'leads','makes','messages'));


        if ($request->ajax()) {
            $cars = $this->inventoryService->all()->where('model', 'LIKE', '%' . $request->search . '%')
                ->orwhere('make', 'LIKE', '%' . $request->search . '%')
                ->orwhere('year', 'LIKE', '%' . $request->search . '%')
                ->get();
            return response()->json(['cars' => $cars]);
        } else {
            $cars = $this->inventoryService->all()->select(['id', 'year', 'make', 'model', 'trim', 'price', 'stock', 'image_from_url',])->get();
            $leads = Lead::with(['tmp_inventories_car', 'user'])->orderBy('id', 'desc')->get();
            $salesmans = Sale::all();
            // return $leads;
            return view('dealer.lead.lead', compact('leads', 'cars', 'salesmans'));
        }
    }

    public function searchVichele(Request $request)
    {
        try
        {
            if ($request->ajax()) {
                $cars = $this->inventoryService->all()->where('model', 'LIKE', '%' . $request->search . '%')
                    ->orwhere('make', 'LIKE', '%' . $request->search . '%')
                    ->orwhere('year', 'LIKE', '%' . $request->search . '%')
                    ->orwhere('vin', 'LIKE', '%' . $request->search . '%')
                    ->get();
                return response()->json(['cars' => $cars]);
            }

        }catch(Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    public function selectCar(Request $request)
    {
        $car = Inventory::where('id', $request->car_id)->select(['id', 'year', 'make', 'model', 'trim', 'price','vin', 'stock', 'image_from_url',])->first();

        $car = [
            'id' => $car->id,
            'title' => $car->title,
            'image' => $car->image,
            'stock' => $car->stock,
        ];
        return response()->json(['car' => $car]);
    }

    public function leadSave(Request $request)
    {

// dd($request->all());

        if ($request->ajax()) {
            $lead = new Lead();
            $user = new User();
            $message = new LeadMessage();
            if ($request->customer_id == null) {
                $validator = Validator::make($request->all(), [

                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'lead_type' => 'required',
                    'source' => 'required',

                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()]);
                }

                $user->username = $request->first_name . ' ' . $request->last_name;
                $user->fname = $request->first_name;
                $user->lname = $request->last_name;
                $user->email = $request->email;
                $user->phone = $request->phone;


                $user->salesperson = $request->salesperson;
                $user->phone_type = $request->phone_type;
                $user->contact_type = $request->contact_type;
                $user->save();
                $message->message = $request->description;
                $message->sender_id = $user->id;
                $message->receiver_id = $request->user_id;
                $message->lead_id = $request->id;
                $message->save();
                $lead->user_id = $user->id;
               $this-> sendMail($request,$user->id);
            } else {
                $validator = Validator::make($request->all(), [

                    'lead_type' => 'required',
                    'source' => 'required',

                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()]);
                }
                $lead->user_id = $request->customer_id;
            }

            $lead->lead_type = $request->lead_type;
            $lead->source = $request->source;
            $lead->inventory_id = $request->vechile_id;
            $lead->note = $request->note;
            $lead->date = now()->format('Y-m-d');
            $lead->save();
            return response()->json(['message' => 'Lead Create successfully']);
        }
    }

    public function showleadModal(Request $request)
    {
        $lead_details = Lead::with(['tmp_inventories_car', 'user'])->where('id', $request->id)->first();
        $lead_details->status = 0;
        $lead_details->save();
        // dd($lead_details);
        $vehicle_name = $lead_details->inventories_car->title;
        $car = $lead_details->inventories_car->image_from_url;
        $car2 = explode(',', $car);
        $final_car =  $car2[0];

        // $messagings= LeadMessage::where(['lead_id' => $request->id,'sender_id'=> Auth::id(),'receiver_id'=> Auth::id()])->get();

        $messagings = LeadMessage::with('user')->where('lead_id', $request->id)->where(function ($query) {
        $userId = Auth::id();
        $query->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId);
        })->get();
        //   $userId = Auth::id();
        // $messagings = LeadMessage::where('lead_id', $request->id);
        // $messagings = $messagings->where('sender_id', $userId)->orwhere('receiver_id', $userId)->get();

        return response()->json([
            'status' => true,
            'lead_details' => $lead_details,
            'final_car' => $final_car,
            'vehicle_name' => $vehicle_name,
            'data'=>$messagings

        ]);
    }

    private function sendMail($request,$id)
    {
        $data =[
            'email'=> $request->email,
            'id'=> $id,
        ];
        Mail::to($request->email)->send(new ConfirmPassword($data));
    }

    public function EditModal(Request $request)
    {
        $lead = Lead::find($request->id);
        return response()->json($lead);
    }

    public function updateLead(Request $request)
    {

        $validator = Validator()->make($request->all(), [
            'vichele_name' => 'required|string',
            'customer' => 'required|string',
            'date' => 'required',
            'lead_type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
        $lead = Lead::find($request->lead_id);
        $lead->vichele_name = $request->vichele_name;
        $lead->customer_name = $request->customer;
        $lead->date = $request->date;
        $lead->lead_type = $request->lead_type;
        $lead->save();
        return response()->json([
            'status' => true,
            'message' => 'Data update Successfully!',
            'data' => $lead
        ]);
    }


    public function deleteLead(Request $request)
    {
        Lead::find($request->id)->delete();
        return response()->json(['status' => true]);
    }


    public function emailLeadSend(Request $request)
    {

        try {


            $lead_details = Lead::with('inventories_car')->find($request->lead_id);
            $email_lead = new LeadMessage();
            if ($request->hasFile('image')) {
                $path = 'dashboard/images/lead_report/';
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($path), $imageName);
                $email_lead->file = $imageName;
            }
            $email_lead->sender_id = auth()->user()->id;
            $email_lead->receiver_id =$lead_details->user->id;
            $email_lead->lead_id = $request->lead_id;
            $email_lead->message = $request->message;
            $email_lead->save();

            $customer_name = $lead_details->user->username;
            $customer_first_name = $lead_details->user->fname;
            $customer_email = $lead_details->user->email;
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
            // $email_message = "this is test message";
            // $data = [
            //     'customer_name'     => $customer_name,
            //     'phone'     => $phone,
            //     'year'          => [$year,$tradeInYear],
            //     'make'          => [$make,$tradeInMake],
            //     'model'          => [$model,$tradeInModel],
            //     'price'             => $price,
            //     'stock'             => $stock,
            //     'miles'             => [$miles,$tradeInMiles],
            //     'vin'             => $tradeInVin,
            //     'color'             => [$ext_color_generic,$tradeInColor],
            //     'email_message'     => $email_message,
            //     'image'     => $image[0],
            //     'customer_first_name' => $customer_first_name,
            //     'customer_email' => $customer_email,
            // ];


            // Mail::to($customer_email)->send(new EmailLeadSMS($data));


            return redirect()->back()->with('message', 'Message sent successfully!');
        } catch (Exception $e) {
            // Handle email sending error, e.g., log the error or display an error message to the user.
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function leadDelete(Request $request)
    {
        Lead::find($request->id)->delete();
        return response()->json(['status'=>'success','message'=>'Lead Delete Successfully.']);
    }


    // public function vechileSearch(Request $request)
    // {

    // }
}
