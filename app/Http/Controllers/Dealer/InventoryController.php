<?php

namespace App\Http\Controllers\Dealer;

use Carbon\Carbon;
use App\Models\Favourite;
use App\Models\Inventory;
use App\Imports\CarImport;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use App\Models\Tmp_inventory;
use App\Imports\InventoryImport;
use Yajra\DataTables\DataTables;
use App\Imports\TmpInventoryImport;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Interface\InventoryServiceInterface;
use App\Models\DealerInfo;

class InventoryController extends Controller
{
    private $inventoryService;
    public function __construct(InventoryServiceInterface $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dealer.inventory.add-inventory');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'vin' => 'required',
            'stock' => 'required',
            'model_year' => 'required',
            'make' => 'required',
            'model' => 'required',
            'body_style' => 'required',
            'price' => 'required',
            'miles' => 'required',
            'description' => 'required',
        ]);

        $inventory = new Inventory();

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $all_image_url = [];
            foreach ($images as $image) {
                $image_url = InventoryImageUpload($image);
                $all_image_url[] = $image_url;
            }
            $inventory->image_from_url = implode(',', $all_image_url);
        }
        $inventory->user_id = Auth::id();
        $inventory->dealer_info_id =$request->dealer_info_id;
        $inventory->vin = $request->vin;
        $inventory->stock = $request->stock;
        $inventory->year = $request->model_year;
        $inventory->make = $request->make;
        $inventory->model = $request->model;
        $inventory->trim = $request->trim_package;
        $inventory->body = $request->body_style;
        $inventory->exterior_color = $request->exterior_color;
        $inventory->interior_color = $request->interior_color;
        $inventory->miles = $request->miles;
        $inventory->price = $request->price;
        $inventory->video_url = $request->video_url;
        $inventory->description = $request->description;
        $inventory->drive_train = $request->drivetrain;
        $inventory->fuel = $request->fuel;
        $inventory->mpg_city = $request->mpg_city;
        $inventory->mpg_hwy = $request->mpg_hwy;
        $inventory->invoice = $request->purchase_price;
        $inventory->date_in_stock = $request->date_in_stock;
        $inventory->transmission = $request->transmission;

        $inventory->model_number = $request->model_number;
        $inventory->doors = $request->doors;
        $inventory->engine_cylinder = $request->engine_cylinder;
        $inventory->engine_displacement = $request->engine_displacement;
        $inventory->retails = $request->retails;
        $inventory->book_value = $request->book_value;
        $inventory->certified = $request->certified;
        $inventory->options = $request->options;
        $inventory->categorized_options = $request->categorized_options;
        $inventory->ext_color_generic = $request->ext_color_generic;
        $inventory->ext_color_code = $request->ext_color_code;
        $inventory->int_color_generic = $request->int_color_generic;
        $inventory->int_color_code = $request->int_color_code;

        $inventory->engine_block_type = $request->engine_block_type;
        $inventory->transmission_speed = $request->transmission_speed;
        $inventory->passenger_capacity = $request->passenger_capacity;
        $inventory->ext_color_hex_Code = $request->ext_color_hex_Code;
        $inventory->int_color_hex_Code = $request->int_color_hex_Code;

        $inventory->save();
        return redirect()->back()->with('message', 'Inventory Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        $inventory_logs = InventoryLog::where('inventory_id', $id)->get();
        $all_images = explode(',', $inventory->image_from_url);
        return view('dealer.inventory.edit_inventory', compact('inventory', 'all_images', 'inventory_logs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Main inventory update kaj baki ase



        // log inventory complete
        $inventory_log = new InventoryLog();
        $inventory_log->dealer_id = $request->dealer_id;
        $inventory_log->inventory_id = $id;
        $inventory_log->mpg_city = $request->mpg_city;
        $inventory_log->mpg_hwy = $request->mpg_hwy;
        $inventory_log->miles = $request->miles;
        $inventory_log->stock = $request->stock;
        $inventory_log->edited_at = now();
        $inventory_log->price = $request->price;
        $inventory_log->purchase_price = $request->purchase_price;
        $inventory_log->save();
        return redirect()->back()->with('message', 'Update Successfully! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function import()
    {
        $cars = $this->inventoryService->all()->paginate(6);
        return view('dealer.car_import', compact('cars'));
    }

    public function importStore(Request $request)
    {
        // abort_if(! auth()->user()->can('hrm_bulk_attendance_import_store'), 403, 'Access forbidden');
        $request->validate([
            'import_file' => 'required|mimes:csv,xlx,xlsx,xls',
        ]);

        Excel::import(new CarImport, $request->import_file);
        session()->flash('success', 'Car Imported successfully!');
        return redirect()->route('car.import');
    }

    public function tmpInventoryImport(Request $request)
    {
        $inventory_all = $this->inventoryService->all()->with('dealers','mediaInfo')->select('trim','image_from_url','price','make','model','year','body','id','transmission','condition','stock_date_formated','payment_price','body_formated')->orderBy('stock_date_formated','desc');
        $inventory_make_array = $inventory_all->orderBy('make')->pluck('id','make')->toArray();
        $inventory_make_list = $inventory_all->orderBy('make')->pluck('id','make')->toArray();
        $inventory_model_list = $inventory_all->orderBy('model')->pluck('id','model');
        $inventory_body= $inventory_all->orderBy('body_formated')->pluck('id','body_formated')->toArray();
        $inventory_year = $inventory_all->orderBy('year')->pluck('id', 'year')->toArray();
        $inventory_min_price = intVal($inventory_all->min('price'));
        $inventory_max_price = intVal($inventory_all->max('price'));
        ksort($inventory_make_list);
        ksort($inventory_body);
        ksort($inventory_year);
        return view('dealer.inventory_import', compact('inventory_make_list','inventory_model_list','inventory_body','inventory_year','inventory_min_price','inventory_max_price'));
    }



    public function tmpInventoryImportStore(Request $request)
    {
        // abort_if(! auth()->user()->can('hrm_bulk_attendance_import_store'), 403, 'Access forbidden');
        $request->validate([
            'import_file' => 'required|mimes:csv,xlx,xlsx,xls',
        ]);

        $import = new TmpInventoryImport;
        Excel::import($import, $request->import_file);

        // Get the counts of inserted and not inserted rows
        $insertedCount = $import->getInsertedCount();
        $notInsertedCount = $import->getNotInsertedCount();
        $archivedCount = $import->getArchivedCount();

        session()->flash('success', 'Inventory Imported (' . $insertedCount . ') successfully! Archived (' . $archivedCount . ') And existed (' . $notInsertedCount . ') inventory.');
        return redirect()->route('inventory.import');
    }


    public function tmpInventoryImportAjax(Request $request)
    {
        $inventories_object = $this->inventoryService->tmpInventoryImportAjax($request)->orderBy('stock_date_formated','desc');
        $inventories = $inventories_object->paginate(12);

        // Render the inventory view as a string
        $view = view('dealer.inventory_ajax', compact('inventories'))->render();

        // Create a paginator instance to get the pagination view
        $paginator = new Paginator($inventories, 12);

        // Render the pagination view as a string
        $pagination = $paginator->links()->render();

        // Return JSON response for Ajax
        return response()->json(['view' => $view, 'pagination' => $pagination]);
    }

    // getItemByFilter

    public function makeModelData(Request $request)
    {
        $data = $this->inventoryService->all();
        $make = $request->make;
        $models_inventory   = $data->where('make', $make)->pluck('id', 'model')->unique();
        return $models_inventory;
    }

    // public function updateWishList(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $ip = $request->ip();
    //         $inventory_id  = $request->inventory_id;
    //         $countWishList = Favourite::countWishList($inventory_id,$ip);
    //         $wishlist = new Favourite();

    //         if ($countWishList == 0) {
    //             $wishlist->inventory_id =$inventory_id;
    //             $wishlist->ip_address = $ip;
    //             $wishlist->save();
    //             return response()->json(['action' => 'add', 'message' => 'Successfully added to favorite']);
    //         } else {
    //             // $user = Auth::user()->id;
    //             Favourite::where(['ip_address' => $ip, 'inventory_id' => $inventory_id])->delete();
    //             return response()->json(['action' => 'remove', 'message' => 'Successfully removed from favorite']);
    //         }
    //     }
        // if ($request->ajax()) {
        //     $data = $request->all();
        //     $countWishList = Favourite::countWishList($data['inventory_id']);
        //     $wishlist = new Favourite();

        //     if ($countWishList == 0) {
        //         $wishlist->inventory_id = $data['inventory_id'];
        //         $wishlist->user_id = $data['user_id'];
        //         $wishlist->save();
        //         return response()->json(['action' => 'add', 'message' => 'Successfully added to favorite']);
        //     } else {
        //         $user = Auth::user()->id;
        //         Favourite::where(['user_id' => $user, 'inventory_id' => $data['inventory_id']])->delete();
        //         return response()->json(['action' => 'remove', 'message' => 'Successfully removed from favorite']);
        //     }
        // }
    // }


    public function updateWishList(Request $request)
    {


        if ($request->ajax()) {
            // session()->flush();
            $favourites = session()->get('favourite');

            $inventory = Inventory::find($request->inventory_id);


            // Check if $favourites is not an array or is empty
            if (!is_array($favourites) || empty($favourites)) {
                $favourites = [];
            }

            $favouriteExists = false;
            foreach ($favourites as $key => $fav) {
                if (isset($fav['id']) && $fav['id'] === $inventory->id) {
                    $favouriteExists = true;
                    unset($favourites[$key]); // Remove the item from the array
                    break;
                }
            }

            if ($favouriteExists) {
                // Update the session with the modified favourites array
                session()->put('favourite', $favourites);

                return response()->json([
                    'action' => 'remove',
                    'message' => 'Removed from favorites',
                ]);
            } else {
                $images = explode(',',$inventory->image_from_url);
                $dato_formate = \Carbon\Carbon::parse($inventory->date_in_stock);
                $newFavourite = [
                    'id' => $inventory->id,
                    'title' => $inventory->title,
                    'date_in_stock' => $dato_formate->diffForHumans(),
                    'fuel' => $inventory->fuel,
                    'miles_formate' => $inventory->miles_formate,
                    'desc' => substr($inventory->description ,0,180),
                    'engine_description_formate' => $inventory->engine_description_formate,
                    'condition' => $inventory->condition,
                    'dealer_city' => $inventory->dealers->dealer_city,
                    'dealer_state' => $inventory->dealers->dealer_state,
                    'year' => $inventory->year,
                    'model' => $inventory->model,
                    'make' => $inventory->make,
                    'img'=>$images[0],
                    'img_count'=>count($images),
                    'price_formate' => $inventory->price_formate,
                    'transmission' => $inventory->transmission,
                ];

                $favourites[] = $newFavourite;
                session()->put('favourite', $favourites);

                return response()->json([
                    'action' => 'add',
                    'message' => 'Added to favourites',
                    'favourite' => $newFavourite,
                ]);
            }
        }


    }
}
