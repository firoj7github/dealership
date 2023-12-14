<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\VisibilityStatusOrInventoryStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Interface\InventoryServiceInterface;
use App\Mail\WaitingEmail;
use App\Mail\WelcomeEmail;
use App\Models\Banner;
use App\Models\Compare;
use App\Models\ContactMessage;
use App\Models\Favourite;
use App\Models\frontend\ContactDealer;
use App\Models\Inventory;
use App\Models\Lead;
use App\Models\News;
use App\Models\Slide;
use App\Models\Tmp_inventory;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator as PaginationLengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\URL;
use Jorenvh\Share\Share;

class SiteController extends Controller
{

    private $inventoryService;
    public function __construct(InventoryServiceInterface $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function index()
    {
        $many_news = News::orderBy('id', 'desc')->wherenotNull('image')->paginate(5);
        $inventory_object = $this->inventoryService->all();
        $info = $inventory_object->orderBy('stock_date_formated', 'desc');
        $makes_data = $inventory_object->orderBy('make')->pluck('id', 'make')->toArray();
        $counts = Inventory::select('make', DB::raw('COUNT(*) as count'))
            ->groupBy('make')
            ->get();
        $inventory_bodies = $inventory_object->pluck('id', 'body_formated')->unique()->toArray();
        $inventories = $inventory_object->where('is_visibility', VisibilityStatusOrInventoryStatus::Active)->limit(12)->get();
        ksort($makes_data);
        ksort($inventory_bodies);

        // $slide = Slide::where('user_id', Auth::id())->where('status', 1)->get();
        $slide = Slide::where('status', 1)->get();


        return view('frontend.home', compact('inventories', 'makes_data', 'counts', 'inventory_bodies', 'many_news', 'slide'));
    }

    public function autos(Request $request)
    {
        $inventory_all = $this->inventoryService->all()->with('dealers', 'mediaInfo')->select('trim', 'image_from_url','vin','stock', 'price', 'make', 'model', 'year', 'body', 'id', 'transmission', 'condition', 'stock_date_formated', 'payment_price', 'body_formated')->orderBy('stock_date_formated', 'desc');
        // $inventory_all = $this->inventoryService->all()->orderBy('stock_date_formated','desc');

        $inventory = $this->inventoryService->getItemByFilter($request);
        $info = $inventory_all;

        $inventory_transmission = $info->pluck('id', 'transmission');
        $inventory_make_list = $info->pluck('id', 'make');
        $inventory_model_list = $info->pluck('id', 'model');
        $inventory_condition = $info->pluck('id', 'condition');
        $inventory_body = $info->pluck('id', 'body_formated');
        $inventory_year = $info->pluck('id', 'year')->toArray();

        $inventory_min_price = (intVal($inventory->min('price'))) < 1000 ? intVal($inventory->min('price')) : 1000;
        $inventory_max_price = (intVal($inventory->max('price'))) > 80000 ? intVal($inventory->max('price')) : 80000;
        $inventory_min_miles = intVal($inventory->min('miles'));
        $inventory_max_miles = intVal($inventory->max('miles'));
        $inventory_min_payment = intVal($inventory->min('payment_price'));
        $inventory_max_payment = intVal($inventory->max('payment_price'));
        $inventories = $inventory->where('is_visibility', VisibilityStatusOrInventoryStatus::Active)->paginate(12);
        $totalCount = $inventories->total();
        // Filter the array to keep only entries where the value is greater than zero
        $filtered_inventory_year = array_filter($inventory_year, function ($value) {
            return $value > 0;
        });

        // Sort the filtered array by keys in descending order
        krsort($filtered_inventory_year);
        // dd($inventory_max_miles);
        $data = [
            'inventory_make_list' => $inventory_make_list,
            'inventory_model_list' => $inventory_model_list,
            'inventory_transmission' => $inventory_transmission,
            'inventory_condition' => $inventory_condition,
            'inventory_body' => $inventory_body,
            'inventory_year' => $filtered_inventory_year,
        ];
        $inventory_related_ad  = $inventory_all->limit(5)->get();
        return view('frontend.auto', compact('inventories', 'inventory_related_ad', 'totalCount', 'inventory_min_price', 'inventory_max_price', 'inventory_min_miles', 'inventory_max_miles', 'inventory_min_payment', 'inventory_max_payment'), $data);
    }

    // public function autoAjax(Request $request)
    // {
    //     $inventory_all = $this->inventoryService->all()->select('trim', 'image_from_url', 'price', 'dealer_name', 'dealer_address', 'dealer_city', 'dealer_state', 'make', 'model', 'year', 'body', 'id', 'transmission', 'condition', 'stock_date_formated', 'payment_price', 'body_formated', 'inventory_media_info.image_from_url AS inventor_image')->orderBy('stock_date_formated', 'desc');
    //     $inventory = $this->inventoryService->getItemByFilter($request);
    //     // $info = $inventory_all ;
    //     // $inventory_transmission = $info->pluck('id','transmission');
    //     // $inventory_make_list = $info->pluck('id','make');
    //     // $inventory_condition = $info->pluck('id','condition');
    //     // $inventory_body= $info->pluck('id','body_formated');
    //     // $inventory_year = $info->pluck('id', 'year')->toArray();

    //     $inventories = $inventory->where('is_visibility', VisibilityStatusOrInventoryStatus::Active)->paginate(12);
    //     $totalCount = $inventories->total();
    //     // // Filter the array to keep only entries where the value is greater than zero
    //     // $filtered_inventory_year = array_filter($inventory_year, function ($value) {
    //     //     return $value > 0;
    //     // });

    //     // Sort the filtered array by keys in descending order
    //     // krsort($filtered_inventory_year);
    //     // dd($filtered_inventory_year);
    //     // $data = [
    //     //     'inventory_make_list' => $inventory_make_list,
    //     //     'inventory_transmission' => $inventory_transmission,
    //     //     'inventory_condition' => $inventory_condition,
    //     //     'inventory_body' => $inventory_body,
    //     //     'inventory_year' => $filtered_inventory_year,
    //     // ];
    //     $inventory_related_ad  = $inventory_all->where('is_visibility', VisibilityStatusOrInventoryStatus::Active)->limit(5)->get();




    //     return response()->json(view('frontend.auto_ajax', compact('inventories', 'totalCount',))->render());
    //     // return view('frontend.auto_ajax', compact('inventories','totalCount'));
    // }

    public function autoFilterAjax(Request $request)
    {

        $inventory = $this->inventoryService->getItemByFilter($request);
        $inventories = $inventory->where('is_visibility', VisibilityStatusOrInventoryStatus::Active)->paginate(12);
        $totalIsFeature = $inventory->where('is_feature',1)->where('is_visibility', VisibilityStatusOrInventoryStatus::Active)->select('id')->paginate(12)->total();
        $totalCount = $inventories->total();
        $compares = Compare::where('ip', $request->ip())->with('lists')->get();

        return response()->json(view('frontend.auto_ajax', compact('inventories', 'totalCount','compares','totalIsFeature'))->render());
    }

    public function autoDetails($vin = null, $modifiedUrlId = null)
{
    try {
        // Retrieve inventory data using InventoryService
        $data = $this->inventoryService->all();

        // Filter active inventories and limit to 3 items
        $inventories = $data->where('is_visibility', VisibilityStatusOrInventoryStatus::Active)
                            ->limit(3)
                            ->get();

        // Find inventory by VIN
        $inventory = $this->inventoryService->findWithVin($vin);
        if (!$inventory) {
            // Handle case where inventory with given VIN is not found
            abort(404, 'Inventory not found');
        }

        // Find other inventories with the same model
        $model = $inventory->model;

        $models_inventory = $data->where('id', '!=', $inventory->id)
                                ->where('model', $model)
                                ->get();
        // return $models_inventory;
        // Retrieve banners for the current user
        $banner = Banner::where('user_id', Auth::id())
                        ->where('status', 1)
                        ->get();

        // Construct share buttons for social media
        $modifiedBodyString = str_replace(' ', '+', $inventory->body);
        $url_id = $inventory->year . '-' . $inventory->make . '-' . $inventory->model . '-' . $modifiedBodyString . '-' . $inventory->stock;

        $shareButtons = \Share::page(url('/used-cars-for-sale' . '/' . $vin . '/' . 'listing' . '/' . $url_id), $inventory->title)
                            ->facebook()
                            ->twitter()
                            ->linkedin()
                            ->whatsapp()
                            ->pinterest()
                            ->telegram();

        // Return data to the view
        return view('frontend.auto_detail', compact('inventory', 'inventories', 'models_inventory', 'banner', 'shareButtons'));
    } catch (\Exception $e) {
        // Handle any unexpected exceptions
        \Log::error('Error in autoDetails: ' . $e->getMessage());
        abort(500, 'Something went wrong');
    }
}

    public function autoDetails34($vin = null,$modifiedUrlId = null)
    {
        // $modifiedUrl  = $modifiedUrlId;
        // $modified_id = explode('-',$modifiedUrl);
        // $id = $modified_id[4];
        // dd($id);

        $data = $this->inventoryService->all();
        $inventories       = $data->where('is_visibility', VisibilityStatusOrInventoryStatus::Active)->limit(3)->get();
        $inventory         = $this->inventoryService->findWithVin($vin);
        $model           = $inventory->model;
        $models_inventory   = $data->where('id', '!=', $inventory->id)->where('model', $model)->get();
        // dd($vin ,$modifiedUrlId,$data,$inventory,$model,$models_inventory);

        $banner = Banner::where('user_id', Auth::id())->where('status', 1)->get();

        $modifiedBodyString = str_replace(' ', '+', $inventory->body);
        $url_id = $inventory->year.'-'.$inventory->make.'-'.$model.'-'.$modifiedBodyString.'-'.$inventory->stock;
        // $shareButtons = \Share::page(url('/used-cars-for-sale-auto-details' . '/' . $inventory->id), $inventory->title)
        $shareButtons = \Share::page(url('/used-cars-for-sale' . '/' .$vin. '/' .'listing'. '/' .$url_id), $inventory->title)
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp()
            ->pinterest()
            ->telegram();


        // // Generate share buttons
        // $shareButtons = \Share::page(
        //     URL::to("/used-cars-for-sale/{$vin}/listing/{$url_id}"),
        //     $inventory['title']
        // )->facebook()->twitter()->linkedin()->whatsapp()->pinterest()->telegram();

        // dd($shareButtons);
        return view('frontend.auto_detail', compact('inventory', 'inventories', 'models_inventory', 'banner', 'shareButtons'));
    }

    public function inactive()
    {

        return view('frontend.inactive');
    }

    public function printInventory($id)
    {
        $inventory = Inventory::find($id);
        $image = explode(',', $inventory->image_from_url);
        $img = $image['0'];

        $data = [

            'title' => $inventory->title,
            'miles' => $inventory->miles,
            'image' => $img,
            'stock' => $inventory->stock,
            'vin' => $inventory->vin,
            'fuel' => $inventory->fuel,
            'engine_cylinder' => $inventory->engine_cylinder,
            'year' => $inventory->year,
            'condition' => $inventory->condition,
            'transmission' => $inventory->transmission,
            'model' => $inventory->model,
            'ext_color_generic' => $inventory->ext_color_generic,
            'drive_train' => $inventory->drive_train,
        ];

        // return view('admin.pdf.inventory_details',compact('data'));

        $pdf = PDF::loadView('admin.pdf.inventory_details', compact('data'));
        return $pdf->stream('details' . rand(1234, 9999) . '.pdf');
    }


    public function setupPassword($id)
    {
        $user = User::find($id);
        return view('frontend.setup-new-password', compact('user'));
    }

    public function login(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6',

       ], [
        'required' => 'The :attribute field is required.',
        'min' => 'The :attribute must be at least :min characters.'
    ]);
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->is_verify_email = 1;
        $user->save();
        // $lead = Lead::where('user_id',$user->id)->orderBy('id','desc')->first();



        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $data =[
                'id' => $user->id,
                'name'=> $user->username,
            ];
                Mail::to($request->email)->send(new WelcomeEmail($data));

            return redirect()->route('buyer.dashboard');

        } else {
            return  redirect()->back()->with('message', 'user name or password invalid!');
        }
    }

    public function recentlyAdded()
    {
        $today = date('Y-m-d',strtotime(date('Y-m-d')));
        $afterSevenDay =  date('Y-m-d',strtotime('-7 days',strtotime(date('Y-m-d'))));
        $recent_inventory = Inventory::whereBetween('stock_date_formated', [$afterSevenDay, $today])->orderBy('stock_date_formated','desc')->paginate(8);
        $total_inventory = count($recent_inventory);
        // dd($today, $afterSevenDay, $total_inventory);
        return view('frontend.recently_added',compact('recent_inventory','total_inventory'));
    }

    public function contactPage($id=null)
    {
        $user = User::find($id);

        return view('frontend.contact-us',compact('user'));
    }

    public function StoreSendMessage(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'captcha' => 'required|captcha',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'The subject field is required.',
            'message.required' => 'The message field is required.',
            'captcha.required' => 'The captcha field is required.',
            'captcha.captcha' => 'The captcha is incorrect.',
        ]);

        $contact_message = new ContactMessage();
        $contact_message->name = $request->name;
        $contact_message->email = $request->email;
        $contact_message->subject = $request->subject;
        $contact_message->message = $request->message;
        $contact_message->save();
        return redirect()->back()->with('message','Message Sent Successfully');
    }


    public function ipAddress(Request $request)
    {
        $ip_address = $request->ip();
        return response()->json(['ip'=> $ip_address]);
    }

    public function favourite(Request $request)
    {

        $favorites = collect(session('favourite'));
        $favoriteIds = $favorites->pluck('id')->toArray(); // 13 item
        $favorites = Inventory::whereIn('id', $favoriteIds)->paginate(10);
        return view('frontend.favourite.index',compact('favorites'));
    }

    public function welcome()
    {
        return view('email.welcome-email');
    }

    public function faqs()
    {
        return view('frontend.faq.index');
    }
    public function about()
    {
        $total_inventory = Inventory::count();
        $total_dealers = User::where('role',2)->count();
        $total_active_user = User::where('status',1)->count();
        $feature_add = Inventory::where('is_feature',1)->count();


        return view('frontend.about.index',compact('total_inventory','total_dealers','total_active_user','feature_add'));
    }
    public function create(){
        $inventories = Inventory::limit(6)->get();
        // return $inventories;
        return view('frontend.dealer.dealerpage', compact('inventories'));
    }

    public function contact(Request $request){

        $validator = Validator::make($request->all(), [
            'fname' => 'required|string',
            'lname' => 'required',
            'email' => 'required',
            'phone' => 'required|string',
            'description' => 'required',

        ], [
            'fname.required' => 'First name is required.',
            'lname.required' => 'Lirst name is required.',
            'email.required' => 'Email field is required.',
            'phone.required' => 'Phone is required.',
            'description.required' => 'Description is required.',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $contact = new ContactDealer();
        $contact->fname = $request->fname;
        $contact->lname = $request->lname;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->description = $request->description;
        $contact->year = $request->year;
        $contact->make = $request->make;
        $contact->model = $request->model;
        $contact->Mileage = $request->Mileage;
        $contact->color = $request->color;
        $contact->save();
        return response()->json([
            'status'=>'success'
        ]);
    }
}
