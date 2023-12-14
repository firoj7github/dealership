<?php

namespace App\Http\Controllers\listing;


use App\Enums\ListingPlanOrPackageType;
use App\Enums\VisibilityStatusOrInventoryStatus;
use App\Http\Controllers\Controller;
use App\Interface\InventoryServiceInterface;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Flysystem\Visibility;
use Yajra\DataTables\DataTables;

class InventorylistingController extends Controller
{
    private $service;
    public function __construct(InventoryServiceInterface $service)
    {
        $this->service = $service;
    }
    public function listingPage(Request $request)
    {

        $infos = $this->service->all()->paginate(20);
        return view('admin.listings.listing', compact('infos'));

        if ($request->ajax()) {
            $data = $this->service->all();
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
                    ->addColumn('plus', function ($row) {
                        $html = '';
                        $html .= '<a href="#" class="toggle-details"><i class="fa-solid fa-circle-plus"></i></a>';

                        return $html;
                    })
                    ->editColumn('img', function ($row) {
                        $imagePath = $row->img ? asset("/dashboard/images/dealers/{$row->img}") : asset('/dashboard/images/avatar.png');
                        return "<img src='{$imagePath}' width='60px'>";
                    })
                    ->addColumn('title', function ($row) {
                        return $row->title;
                    })
                    ->addColumn('dealer', function ($row) {
                        return $row->user->username;
                    })
                    ->addColumn('category', function ($row) {
                        return $row->make.'/'.$row ->model;
                    })
                    ->addColumn('payment', function ($row) {
                        return  $row->payment_date ? Carbon::parse($row->featured_till)->format('m-d-Y') : 'Null';
                    })
                    ->addColumn('active', function ($row) {
                        return  $row->active_till ? Carbon::parse($row->active_till)->format('m-d-Y') : 'Null';

                    })
                    ->addColumn('feature', function ($row) {
                        return  $row->featured_till ? Carbon::parse($row->featured_till)->format('m-d-Y') : 'Null';

                    })
                    ->addColumn('package', function ($row) {

                    //     if($row->package == ){

                    //     }

                    //     $html = `<select class="status-select form-control {{ $info->package == $featuredListingPlanorpackageStatus ? 'bg-warning' : '' }}"
                    //     style="font-size:10px; font-weight:bold; opacity:97%" name="package"
                    //     data-id="{{ $info->id }}">
                    //     <option value="{{ $standardeListingPlanorpackageStatus }}"
                    //         {{ $info->package == $standardeListingPlanorpackageStatus ? 'selected' : '' }}>
                    //         Free Package</option>
                    //     <option value="{{ $featuredListingPlanorpackageStatus }}"
                    //         {{ $info->package == $featuredListingPlanorpackageStatus ? 'selected' : '' }}>
                    //         Featured Package
                    //     </option>

                    // </select>`

                    })

                    ->editColumn('role', function ($row) {

                        return $row->role == 2 ? "Dealer" : "Seller";

                    })
                    ->addColumn('membership', function ($row) {

                    $membership_html_1 = "<select class='display-select form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='{{ $row->id }}'>
                    <option value='0'>Standard</option>
                    <option value='1'>Copper</option>
                    <option value='2'>Bronze</option>
                    <option value='3'>Silver</option>
                    <option value='4'>Gold</option>
                    <option value='5'>Plutinum</option>
                    <option value='6'>Blocked</option>
                 </select>";
                    $membership_html_2 = "<select name='' id='' class='display-select form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='{{ $row->id }}'>
                       <option value='0'>Standard</option>
                       <option value='1'>Premium</option>
                       <option value='2'>Exclusive</option>
                       <option value='3'>Silver</option>
                       <option value='4'>Sponsored</option>
                       <option value='5'>Blocked</option>
                 </select>";

                        return $row->role == 2 ? $membership_html_1 : $membership_html_2;

                    })
                    ->editColumn('status', function ($row) {
                        $html = "<select class='action-select " . ($row->status == 1 ? 'bg-success' : '') . " form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                    <option " . ($row->status == 1 ? 'selected' : '') . " value='active'>Active</option>
                                    <option " . ($row->status == 0 ? 'selected' : '') . " value='inactive'>Inactive</option>
                                </select>";
                        return $html;
                    })


                    ->addColumn('action', function ($row) {
                        $html = '<a href="'. route('img.show', $row->id) .'" class="text-secondary"><i class="fa fa-image"></i></a>&nbsp;'.
                                '<a href="'. route('listing.show', $row->id) .'" class="text-info"><i class="fa fa-eye"></i></a>&nbsp;'.
                                '<a href="'. route('listing.edit', $row->id).'" class="edit_news_form text-info"><i class="fa fa-edit"></i></a>&nbsp;'.
                                '<a href="#" data-id="'. $row->id .'" class="listing_delete text-danger"><i class="fa fa-delete-left"></i> </a>';

                        return $html;
                    })


                    ->rawColumns(['action','check','plus','username','img','role','membership','status'])
                    ->make(true);
        }

        return view('admin.listings.listing');
    }
    public function imgShow($id)
    {
        $packages = $this->service->find($id);
        return view('admin.listings.singlelistingimage', compact('packages'));
    }
    public function listingShow($id)
    {
        $lists = $this->service->find($id);
        // return $lists;
        return view('admin.listings.listingdetails', compact('lists'));
    }
    public function edit($id)
    {

        $inventory = Inventory::find($id);

        $all_images = explode(',', $inventory->image_from_url);

        // return $lists;
        return view('admin.listings.listingedit', compact('inventory', 'all_images'));
    }

    public function updatePackage(Request $request)
{
    $feature_update = Inventory::find($request->id);
    if ($request->package == ListingPlanOrPackageType::Standard->value) {
        $feature_update->package = ListingPlanOrPackageType::Standard->value;
        $feature_update->active_till = null;
        $feature_update->featured_till = null;
    } elseif ($request->package == ListingPlanOrPackageType::Feature->value) {
        $feature_update->package = ListingPlanOrPackageType::Feature->value;
        $feature_update->active_till = now();
        $feature_update->featured_till = now()->copy()->addDays(30);
    }

    $feature_update->save();
    $change_package = [
        'package' => $feature_update->package,
        'active_till' => $feature_update->active_till ? Carbon::parse($feature_update->active_till)->format('m-d-Y') : null,
        'featured_till' => $feature_update->featured_till ? Carbon::parse($feature_update->featured_till)->format('m-d-Y') : null,
    ];

    return response()->json(['status' => 'success',
    'message'=>'Package Update successfully',
     'data' => $change_package]);
}

public function updateStatus(Request $request){

    $inventory_status= Inventory::find($request->id);
// dd($inventory_status);
    if($request->status == VisibilityStatusOrInventoryStatus::Active->value){
        $inventory_status->status = VisibilityStatusOrInventoryStatus::Active->value;
    }
    elseif($request->status == VisibilityStatusOrInventoryStatus::Inactive->value){
        $inventory_status->status = VisibilityStatusOrInventoryStatus::Inactive->value;

    }


    $inventory_status->save();
    return response()->json([
        'status'=>'success',
        'current_status' =>$inventory_status->status
    ]);

}

public function displayUpdateStatus(Request $request) {

    // dd($request->all());
    $inventory_status = Inventory::find($request->id);
    // $inventory_status->is_visibility = $request->status == VisibilityStatusOrInventoryStatus::Active->value ? VisibilityStatusOrInventoryStatus::Active->value : $inventory_status->is_visibility;
    // $inventory_status->is_visibility = $request->status == VisibilityStatusOrInventoryStatus::Inactive ->value ? VisibilityStatusOrInventoryStatus::Inactive ->value : $inventory_status->is_visibility;

    if($request->is_visibility == VisibilityStatusOrInventoryStatus::Active->value)
    {
        $inventory_status->is_visibility = $request->status;
    }
    elseif($request->is_visibility == VisibilityStatusOrInventoryStatus::Inactive->value)
    {
        $inventory_status->is_visibility = $request->status;

    }
    elseif($request->is_visibility == VisibilityStatusOrInventoryStatus::Expired->value){
        $inventory_status->is_visibility = $request->status;

    }
    elseif($request->is_visibility == VisibilityStatusOrInventoryStatus::Archived->value){
        $inventory_status->is_visibility = $request->status;

    }
    elseif($request->is_visibility == VisibilityStatusOrInventoryStatus::Invalid->value){
        $inventory_status->is_visibility = $request->status;

    }
    else{
        $inventory_status->is_visibility = $request->status;
    }
    $inventory_status->save();
    return response()->json(['status' => 'success','current_display' =>$inventory_status->is_visibility]);
}

public function add(){
    return view('admin.listings.listingaddinventory');
}
public function delete(Request $request){

      $listing= Inventory::find($request->id);
      $listing->delete();
    //   $listing->is_archive = 'yes';
    //     $listing->save();

        return response()->json([
            'status'=>'success'
        ]);


}
public function permanentDelete(Request $request){

      $listing= Inventory::find($request->id);
      $listing->forceDelete();
    //   $listing->is_archive = 'yes';
    //     $listing->save();

        return response()->json([
            'status'=>'success'
        ]);


}

public function archived()
{
    $archived_inventories = $this->service->all()->where('is_archive',VisibilityStatusOrInventoryStatus::Archived)->paginate(10);
    return view('admin.listings.archived',compact('archived_inventories'));
}

public function Removed_archived(Request $request)
{
    $listing= Inventory::find($request->id);
    $listing->is_archive = 'no';
    $listing->save();

      return response()->json([
          'status'=>'success'
      ]);


}

}
