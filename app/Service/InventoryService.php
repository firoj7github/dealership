<?php
namespace App\Service;

use App\Models\Car;
use App\Models\Inventory;
use App\Models\DealerInfo;
use App\Models\Tmp_inventory;
use App\Interface\InventoryServiceInterface;
use App\Enums\VisibilityStatusOrInventoryStatus;
use App\Models\ArchivedTmpInventories;

class InventoryService implements InventoryServiceInterface
{
    // public function __construct(
    //     private FileUploaderServiceInterface $uploader,
    // ) {
    // }

    public function all()
    {
        // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
        $inventories = Inventory::query();
        return $inventories;
    }

    public function soldListing()
    {
        // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
        $inventories = ArchivedTmpInventories::query();
        return $inventories;
    }

    public function archiveListing()
    {
        // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
        $inventories = Inventory::whereNotNull('deleted_at')->get();
        return $inventories;
    }

    //Get Trashed Item list
    public function getTrashedItem()
    {
        // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
        $item = Inventory::onlyTrashed()->orderBy('id', 'desc')->get();

        return $item;
    }

    public function store(array $visits)
    {
        // abort_if(! auth()->user()->can('hrm_visit_create'), 403, 'Access Forbidden');
        // if (isset($visits['attachments'])) {
        //     $visits['attachments'] = $this->uploader->upload($visits['attachments'], 'uploads/visits/');
        // }
        // $item = Tmp_inventory::create($visits);

        // return $item;
    }

    public function find(int $id)
    {
        // abort_if(! auth()->user()->can('hrm_visit_view'), 403, 'Access Forbidden');
        $item = Inventory::find($id);
        return $item;
    }

    public function update(array $visit, int $id)
    {
        // abort_if(! auth()->user()->can('hrm_visit_update'), 403, 'Access Forbidden');
        // $item = Tmp_inventory::find($id);
        // if (isset($visit['attachments'])) {
        //     if (isset($visit['attachments']) && ! empty($visit['attachments']) && file_exists('uploads/visits/'.$visit['old_photo']) && $visit['old_photo'] != null) {
        //         unlink(public_path('uploads/visits/'.$visit['old_photo']));
        //     }
        //     $visit['attachments'] = $this->uploader->upload($visit['attachments'], 'uploads/visits/');
        // } else {
        //     // unlink(public_path('uploads/visits/'.$visit['old_photo']));
        //     $visit['attachments'] = null;
        // }
        // $updatedItem = $item->update($visit);

        // return $updatedItem;
    }

    //Move To Trash
    public function trash(int $id)
    {
        // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
        $item = Inventory::find($id);
        $item->delete($item);

        return $item;
    }

    // File Delete
    public function visitFileDelete($id)
    {
        // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
        // $item = Tmp_inventory::findOrFail($id);
        // $filePath = public_path('uploads/visits/'.$item->attachments);
        // if (\file_exists($filePath)) {
        //     unlink($filePath);
        // }
        // $item->attachments = null;
        // $fileDelete = $item->save();

        // return $fileDelete;
    }

    //Bulk Move To Trash
    public function bulkTrash(array $ids)
    {
        // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
        // foreach ($ids as $id) {
        //     $item = Tmp_inventory::find($id);
        //     $item->delete($item);
        // }

        // return $item;
    }

    //Permanent Delete
    public function permanentDelete(int $id)
    {
        // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
        $item = Inventory::onlyTrashed()->find($id);
        $item->forceDelete();

        return $item;
    }

    //Bulk Permanent Delete
    public function bulkPermanentDelete(array $ids)
    {
        // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
        // foreach ($ids as $id) {
        //     $item = Tmp_inventory::onlyTrashed()->find($id);
        //     $item->forceDelete($item);
        // }

        // return $item;
    }

    //Restore Trashed Item
    public function restore(int $id)
    {

        // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
        // $item = Tmp_inventory::withTrashed()->find($id)->restore();

        // return $item;
    }

    //Bulk Restore Trashed Item
    public function bulkRestore(array $ids)
    {
        // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
        // foreach ($ids as $id) {
        //     $item = Tmp_inventory::withTrashed()->find($id);
        //     $item->restore($item);
        // }

        // return $item;
    }

    //Get Row Count
    public function getRowCount()
    {
        // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
        $count = Inventory::all()->count();

        return $count;
    }

    //Get Trashed Item Count
    public function getTrashedCount()
    {
        // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
        $count = Inventory::onlyTrashed()->count();

        return $count;
    }

    public function tmpInventoryImportAjax($request)
    {
        $inventories = Inventory::where('is_visibility', VisibilityStatusOrInventoryStatus::Active);
                //ajax filter
                if($request->action == 'fetch_data')
                {

                    if($request->make){
                        $inventories->where('make', $request->make);
                    }
                    if($request->model){
                        $inventories->where('model', $request->model);
                    }
                    if($request->body){
                        $inventories->where('body_formated', $request->body);
                    }
                    if($request->year){
                        $inventories->where('year', $request->year);
                    }
                    if($request->min_price){
                        $inventories->where('price','>' ,$request->min_price);
                    }
                    if($request->max_price){
                        $inventories->where('price','<', $request->max_price);
                    }
                }
        return $inventories;
    }

    public function getItemByFilter($request)
    {
            // dd($request->all());

        // abort_if(!auth()->user()->can('hrm_employees_index'), 403, 'Access Forbidden');

        // $query = Tmp_inventory::orderBy('stock_date_formated','desc');
        $query = Inventory::with('dealers');

        // if ($request->showTrashed == 'true') {
        //     $query = $item = Tmp_inventory::onlyTrashed()->orderBy('id', 'desc');
        // } else {
        //     $query = Tmp_inventory::with(['section', 'designation', 'grade'])->orderBy('id', 'desc');
        // action:action, mimimun_price:mimimun_price, maximun_price:maximun_price, ajaxbrand:brand, ajaxtransmission:transmission, ajaxbody:body, ajaxyear:year
        // }

        //ajax filter
        if($request->action == 'mobile_fetch_data')
        {

            if ($request->mobile_search_car) {
                $searchWords = explode(' ', $request->mobile_search_car);

                $query->where(function ($subquery) use ($searchWords) {
                    $subquery->where(function ($subquery2) use ($searchWords) {
                        foreach ($searchWords as $word) {
                            $subquery2->where(function ($subquery3) use ($word) {
                                $subquery3->where('make', 'like', '%' . $word . '%')
                                    ->orWhere('year', 'like', '%' . $word . '%')
                                    ->orWhere('stock', 'like', '%' . $word . '%')
                                    ->orWhere('body', 'like', '%' . $word . '%')
                                    ->orWhere('model', 'like', '%' . $word . '%');
                            });
                        }
                    })
                    ->orWhere(function ($subquery4) use ($searchWords) {
                        $subquery4->whereRaw("CONCAT_WS('', year, make, model, body) LIKE ?", ['%' . implode('%', $searchWords) . '%']);
                    });
                });
            }

            if($request->mobile_minimun_price){
                     $query->where('price', '>=',$request->mobile_minimun_price);
            }
            if($request->mobile_maximun_price){
                    $query->where('price', '<=',$request->mobile_maximun_price);
            }

            if($request->mobile_mimimun_mileage){
                    $query->where('miles', '>=',$request->mobile_mimimun_mileage);
            }
            if($request->mobile_maximun_mileage){
                    $query->where('miles', '<=',$request->mobile_maximun_mileage);
            }

            if($request->mobile_mimimun_years){
                    $query->where('year', '>=',$request->mobile_mimimun_years);
            }
            if($request->mobile_maximun_years){
                    $query->where('year', '<=',$request->mobile_maximun_years);
            }

            if($request->mobile_minimun_payment){
                    $query->where('payment_price', '>=',$request->mobile_minimun_payment);
            }

            if($request->mobile_maximun_payment){
                    $query->where('payment_price', '<=',$request->mobile_maximun_payment);
            }

            if($request->mobile_ajax_brand){
                $query->whereIn('make', $request->mobile_ajax_brand);
            }

            if($request->mobile_ajax_body){
                $query->whereIn('body_formated', $request->mobile_ajax_body);
            }
            if($request->mobile_ajax_transmission){
                $query->whereIn('transmission', $request->mobile_ajax_transmission);
            }
            if($request->mobile_ajax_year){
                $query->whereIn('year', $request->mobile_ajax_year);
            }
            //
        }


        if($request->action == 'fetch_data')
        {
            // dd($request->all());
    //         $results = YourModel::where('column1', 'like', '%your_search_string%')
    // ->orWhere('column2', 'like', '%your_search_string%')
    // ->orWhere('column3', 'like', '%your_search_string%')
    // // Add more conditions as needed
    // ->get();

            if ($request->search_car) {
                $searchWords = explode(' ', $request->search_car);

                $query->where(function ($subquery) use ($searchWords) {
                    $subquery->where(function ($subquery2) use ($searchWords) {
                        foreach ($searchWords as $word) {
                            $subquery2->where(function ($subquery3) use ($word) {
                                $subquery3->where('make', 'like', '%' . $word . '%')
                                    ->orWhere('year', 'like', '%' . $word . '%')
                                    ->orWhere('stock', 'like', '%' . $word . '%')
                                    ->orWhere('body', 'like', '%' . $word . '%')
                                    ->orWhere('model', 'like', '%' . $word . '%');
                            });
                        }
                    })
                    ->orWhere(function ($subquery4) use ($searchWords) {
                        $subquery4->whereRaw("CONCAT_WS('', year, make, model, body) LIKE ?", ['%' . implode('%', $searchWords) . '%']);
                    });
                });
            }
            // if($request->search_car){
            //     $query->where('make', 'like','%'.$request->search_car.'%')
            //           ->orWhere('year','like','%'.$request->search_car.'%')
            //           ->orWhere('stock','like','%'.$request->search_car.'%')
            //           ->orWhere('body','like','%'.$request->search_car.'%')
            //           ->orWhere('model','like','%'.$request->search_car.'%')
            //             // Add more conditions as needed for other fields
            //         ->orWhereRaw("CONCAT_WS('', year, make, model, body) LIKE ?", ['%' . $request->search_car . '%']);
            // }
            if($request->ajaxtransmission){
                $query->whereIn('transmission', $request->ajaxtransmission);
            }
            if($request->ajaxbrand){
                $query->whereIn('make', $request->ajaxbrand);
            }
            if($request->ajaxmake || $request->make_filter_input_mobile){
                if($request->make_filter_input_mobile != null){
                    $query->where('make', $request->make_filter_input_mobile);
                }else{

                    $query->where('make', $request->ajaxmake);
                }
            }
            if($request->ajaxmodel || $request->model_filter_input_mobile){
                 if($request->model_filter_input_mobile != null){
                    $query->where('model', $request->model_filter_input_mobile);
                 }  else{

                     $query->where('model', $request->ajaxmodel);
                 }
            }
            if($request->ajaxbodies || $request->body_filter_input_mobile){
                if($request->body_filter_input_mobile != null){
                    $query->where('body_formated', $request->body_filter_input_mobile);
                 }  else{

                     $query->where('body_formated', $request->ajaxbodies);
                 }
                // $query->where('body_formated', $request->ajaxbodies);
            }


            if($request->ajaxmakeMobile){
                $query->where('make', $request->ajaxmakeMobile);
            }
            if($request->ajaxmodelMobile){
                $query->where('model', $request->ajaxmodelMobile);
            }
            if($request->ajaxbodiesMobile){
                $query->where('body_formated', $request->ajaxbodiesMobile);
            }

            if($request->ajaxyear){
                $query->whereIn('year', $request->ajaxyear);
            }

            if($request->ajaxbody){
                $query->whereIn('body_formated', $request->ajaxbody);
            }

            if($request->mimimun_price || $request->min_price_mobile || $request->price_range){

                if($request->min_price_mobile){
                    $a= $query->where('price', '>=',$request->min_price_mobile);
                }
                // elseif($request->price_range)
                // {
                //     $price_data =  $request->price_range ;
                //     $cleanedStringPrice = str_replace(['$', ' '], '', $price_data);
                //     $explodedValues = explode('-', $cleanedStringPrice);
                //     // $query->whereBetween('price', [$explodedValues[0], $explodedValues[1]])->get();
                //     $query->where('price', '>=',$explodedValues[0]);
                // }
                else{
                    $a = $query->where('price', '>=',$request->mimimun_price);
                }
            }

            if($request->maximun_price || $request->max_price_mobile || $request->price_range){

                if($request->max_price_mobile){
                   $b =  $query->where('price', '<=',$request->max_price_mobile);
                }
                // elseif($request->price_range)
                // {
                //     $price_data =  $request->price_range ;
                //     $cleanedStringPrice = str_replace(['$', ' '], '', $price_data);
                //     $explodedValues = explode('-', $cleanedStringPrice);
                //     // $query->whereBetween('price', [$explodedValues[0], $explodedValues[1]])->get();
                //     $query->where('price', '<=',$explodedValues[1]);
                // }
                else{
                   $b =  $query->where('price', '<=',$request->maximun_price);
                }
            }

            // if($request->price_range )
            // {
            //     $price_data =  $request->price_range ;
            //     $cleanedStringPrice = str_replace(['$', ' '], '', $price_data);
            //     $explodedValues = explode('-', $cleanedStringPrice);
            //     $query->whereBetween('price', [$explodedValues[0], $explodedValues[1]])->get();
            // }

            if($request->mimimun_mileage || $request->min_year_miles_mobile){
                if($request->min_year_miles_mobile){
                    $query->where('miles', '>=',$request->min_year_miles_mobile);
                }else{
                    $query->where('miles', '>=',$request->mimimun_mileage);
                }
            }

            if($request->maximun_mileage || $request->mobile_max_miles){
                if($request->mobile_max_miles != null){
                    $query->where('miles', '<=',$request->mobile_max_miles);
                }else{
                    $query->where('miles', '<=',$request->maximun_mileage);
                }
            }
            if($request->mimimun_years || $request->min_year_mobile){
                if($request->min_year_mobile != null){
                    $query->where('year', '>=',$request->min_year_mobile);
                }else{
                    $query->where('year', '>=',$request->mimimun_years);
                }
            }

            if($request->maximun_years || $request->max_year_mobile){
                if($request->max_year_mobile != null){
                    $query->where('year', '<=',$request->max_year_mobile);
                }else{
                    $query->where('year', '<=',$request->maximun_years);
                }
            }

            if($request->minimun_payment || $request->min_payment_mobile){
                if($request->min_payment_mobile != null){
                    $query->where('payment_price', '>=',$request->min_payment_mobile);
                }else{
                    $query->where('payment_price', '>=',$request->minimun_payment);
                }
            }

            if($request->maximun_payment || $request->max_payment_mobile){
                if($request->max_payment_mobile != null){
                    $query->where('payment_price', '<=',$request->max_payment_mobile);
                }else{
                    $query->where('payment_price', '<=',$request->maximun_payment);
                }
            }
        }

        return $query->orderBy('stock_date_formated','desc');
    }

    public function getByUserId(int $userId)
    {
        $item = Inventory::where('user_id',$userId)->get();
        return $item;
    }
    public function findWithVin($vin)
    {

        // abort_if(! auth()->user()->can('hrm_visit_view'), 403, 'Access Forbidden');
        $item = Inventory::where('vin',$vin)->first();
        return $item;
    }

}


?>
