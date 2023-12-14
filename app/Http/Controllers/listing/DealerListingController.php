<?php

namespace App\Http\Controllers\listing;

use App\Enums\MembershipType;
use App\Http\Controllers\Controller;
use App\Interface\InventoryServiceInterface;
use App\Models\DealerInfo;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;
use Yajra\DataTables\DataTables;

class DealerListingController extends Controller
{
    private $service;
    public function __construct(InventoryServiceInterface $service)
    {
        $this->service = $service;
    }








    public function listingView(Request $request)
    {
        // $infos = Inventory::query();
        // $inventories = $infos->with('user')->where('user_id', Auth::id())->paginate(20);
        // $user = $inventories->first()->user ?? null;
        if ($request->ajax()) {
            $data = $this->service->all();
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
                        return  $row->title;
                    })
                    ->addColumn('active_start', function ($row) {
                        return  $row->stock_date_formated ? Carbon::parse($row->stock_date_formated)->format('m-d-Y') : 'null';;
                    })
                    ->addColumn('active_end', function ($row) {
                        return  $row->stock_date_formated ? Carbon::parse($row->stock_date_formated)->addDays(30)->format('m-d-Y') : 'null';;
                    })
                    ->addColumn('active_till', function ($row) {
                        return  $row->active_till ? Carbon::parse($row->active_till)->format('m-d-Y') : 'null';;
                    })
                    ->addColumn('featured_till', function ($row) {
                        return  $row->featured_till ? Carbon::parse($row->featured_till)->addDays(30)->format('m-d-Y') : 'null';;
                    })
                    ->addColumn('category', function ($row) {
                        return  $row->make .'/'. $row->model;
                    })
                    ->addColumn('payment', function ($row) {
                        return  $row->payment_date ? Carbon::parse($row->payment_date)->format('m-d-Y') : 'null';;
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
                        $html = "<select class='action-add " . ($row->is_visibility == 1 ? 'bg-success' : '') . " form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                    <option " . ($row->is_visibility == 1 ? 'selected' : '') . " value='1'>Active</option>
                                    <option " . ($row->is_visibility == 0 ? 'selected' : '') . " value='0'>Inactive</option>
                                </select>";
                        return $html;
                    })

                    ->addColumn('action', function ($row) {

                        $html = '<a class="text-white btn btn-sm  btn-info m-1" title="picture"  href="'. route('picture.show', $row->id) .'" class="text-secondary"><i class="fa fa-image"></i> </a>'.
                                 '<a title="View" href="'. route('listing.single', $row->id) .'" class="text-white btn btn-sm  btn-warning m-1"><i class="fa fa-eye"></i> </a>'.
                                 '<a title="Edit" href="'. route('inventory.edit', $row->id) .'" class="edit_news_form text-white btn btn-sm  btn-primary m-1"><i class="fa fa-edit"></i> </a>'.
                                 '<a title="Delete" href="#" data-id='.$row->id.' class="listing_delete text-white btn btn-sm  btn-danger m-1"> <i class="fa fa-delete-left"></i> </a>';
                        return $html;
                    })


                    ->rawColumns(['plus','action','check','status','package'])
                    ->make(true);
        }
        return view('dealer.listings.dealerlisting');
        // return view('dealer.listings.dealerlisting', compact('infos'));
    }
    public function imgAll($id)
    {
        $packages = $this->service->find($id);
        return view('dealer.listings.dealerlistingimage', compact('packages'));
    }
    public function singleListing($id)
    {
        $lists = $this->service->find($id);
        // return $lists;
        return view('dealer.listings.dealersinglelisting', compact('lists'));
    }
    public function delete(Request $request){

        $listing= Inventory::find($request->id);
          $listing->delete();

          return response()->json([
              'status'=>'success'
          ]);


  }
  public function restore(Request $request)
  {
      if ($request->packagePlan == '0') {
          $listingIds = $request->ListingSelectedData ?? [];
          $listings = Inventory::withTrashed()->whereIn('id', $listingIds)->get();
          $listings->each->restore();
      } else {
          $listingId = $request->id ?? null;
          if ($listingId) {
              $listing = Inventory::withTrashed()->find($listingId);
              if ($listing) {
                  $listing->restore();
              }
          }
      }

      return response()->json([
          'status' => 'success'
      ]);
  }


  public function updatePac(Request $request)
{
    $feature_update = Inventory::find($request->id);

    if ($request->package == 'free') {
        $feature_update->package = 'free';
        $feature_update->active_till = null;
        $feature_update->featured_till = null;
    } elseif ($request->package == 'featured') {
        $feature_update->package = 'featured';
        $feature_update->active_till = now();
        $feature_update->featured_till = now()->copy()->addDays(30);
    }

    $feature_update->save();


    return response()->json(['status' => 'success',
    'message'=>'Package Update successfully'
     ]);
}

public function updateAction(Request $request){

    $inventory_status= Inventory::find($request->id);

    if($request->status == 1){

        $inventory_status->is_visibility = 1;
    } elseif($request->status == 0){
        $inventory_status->is_visibility = 0;

    }

    $inventory_status->save();
    return response()->json([
        'status'=>'success',
    ]);

}


public function insert(){
    $dealer = DealerInfo::where('user_id', Auth::id())->first();


    return view('dealer.inventory.add-inventory', compact('dealer'));
}


public function soldListing(Request $request)
{

    if ($request->ajax()) {
        $data = $this->service->soldListing();

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
                    return  $row->title;
                })
                ->addColumn('active_start', function ($row) {
                    return  $row->stock_date_formated ? Carbon::parse($row->stock_date_formated)->format('m-d-Y') : 'null';;
                })
                ->addColumn('active_end', function ($row) {
                    return  $row->stock_date_formated ? Carbon::parse($row->stock_date_formated)->addDays(30)->format('m-d-Y') : 'null';;
                })
                // ->addColumn('active_till', function ($row) {
                //     return  $row->active_till ? Carbon::parse($row->active_till)->format('m-d-Y') : 'null';;
                // })
                // ->addColumn('featured_till', function ($row) {
                //     return  $row->featured_till ? Carbon::parse($row->featured_till)->addDays(30)->format('m-d-Y') : 'null';;
                // })
                ->addColumn('category', function ($row) {
                    return  $row->make .'/'. $row->model;
                })
                // ->addColumn('payment', function ($row) {
                //     return  $row->payment_date ? Carbon::parse($row->payment_date)->format('m-d-Y') : 'null';;
                // })
                ->addColumn('status', function ($row) {
                    $html = "<select class='action-add " . ($row->is_visibility == 1 ? 'bg-success' : '') . " form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                <option " . ($row->is_visibility == 1 ? 'selected' : '') . " value='1'>Available</option>
                                <option " . ($row->is_visibility == 0 ? 'selected' : '') . " value='0'>Sold</option>
                            </select>";
                    return $html;
                })

                ->addColumn('action', function ($row) {

                    $html = '<a class="text-white btn btn-sm  btn-info m-1" title="picture"  href="'. route('picture.show', $row->id) .'" class="text-secondary"><i class="fa fa-image"></i> </a>'.
                             '<a title="View" href="'. route('listing.single', $row->id) .'" class="text-white btn btn-sm  btn-warning m-1"><i class="fa fa-eye"></i> </a>'.
                            //  '<a title="Edit" href="'. route('inventory.edit', $row->id) .'" class="edit_news_form text-white btn btn-sm  btn-primary m-1"><i class="fa fa-edit"></i> </a>'.
                             '<a title="Delete" href="#" data-id='.$row->id.' class="listing_delete text-white btn btn-sm  btn-danger m-1"> <i class="fa fa-delete-left"></i> </a>';
                    return $html;
                })


                ->rawColumns(['plus','action','check','status','package'])
                ->make(true);
    }
    return view('dealer.listings.soldlisting');
    // return view('dealer.listings.dealerlisting', compact('infos'));
}


public function archiveListing(Request $request)
{
    if ($request->ajax()) {
        $data = $this->service->getTrashedItem();

        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $html = '';
                    $html .= '<div class="icheck-primary  text-center">
                    <input type="checkbox" name="inventory_id[]" value="' . $row->id . '" class="mt-2 check1  check-row" data-id="'. $row->id .'">
                    </div>';

                    return $html;
                })
                // ->addColumn('plus', function ($row) {
                //     return  "<a href='#' class='toggle-details'><i
                //     class='fa-solid fa-circle-plus'></i></a>"; // Use plus for collapse
                // })
                ->addColumn('title', function ($row) {
                    return  $row->title;
                })
                ->addColumn('active_start', function ($row) {
                    return  $row->stock_date_formated ? Carbon::parse($row->stock_date_formated)->format('m-d-Y') : 'null';;
                })
                ->addColumn('active_end', function ($row) {
                    return  $row->stock_date_formated ? Carbon::parse($row->stock_date_formated)->addDays(30)->format('m-d-Y') : 'null';;
                })
                ->addColumn('active_till', function ($row) {
                    return  $row->active_till ? Carbon::parse($row->active_till)->format('m-d-Y') : 'null';;
                })
                ->addColumn('featured_till', function ($row) {
                    return  $row->featured_till ? Carbon::parse($row->featured_till)->addDays(30)->format('m-d-Y') : 'null';;
                })
                ->addColumn('category', function ($row) {
                    return  $row->make .'/'. $row->model;
                })
                ->addColumn('payment', function ($row) {
                    return  $row->payment_date ? Carbon::parse($row->payment_date)->format('m-d-Y') : 'null';;
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
                // ->addColumn('status', function ($row) {
                //     $html = "<select class='action-add " . ($row->is_visibility == 1 ? 'bg-success' : '') . " form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                //                 <option " . ($row->is_visibility == 1 ? 'selected' : '') . " value='1'>Active</option>
                //                 <option " . ($row->is_visibility == 0 ? 'selected' : '') . " value='0'>Inactive</option>
                //             </select>";
                //     return $html;
                // })

                ->addColumn('action', function ($row) {

                    $html =  '<a title="Delete" href="#" data-id='.$row->id.' class="listing_restore text-white btn btn-sm  btn-danger m-1"><i class="fa-solid fa-rotate-right"></i></a>';
                    return $html;
                })


                ->rawColumns(['plus','action','check','status','package'])
                ->make(true);
    }
    return view('dealer.archive.archivelisting');
}


}
