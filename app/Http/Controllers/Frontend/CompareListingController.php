<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use App\Models\Inventory;
use Illuminate\Http\Request;

class CompareListingController extends Controller
{
    public function add(Request $request)
    {

        $existingItem = Compare::where('inventory_id', $request->id)->first();


        if (empty($existingItem)) {

            $limit= Compare::where('ip', $request->ip())->count();




            if($limit < 3){
            $compare = new Compare();
            $compare->inventory_id = $request->id;
            $compare->ip = $request->ip();
            $compare->save();
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Already Add Three Listing',
                    'data' => $this->compare_all_data_get($request),
                ]);

            }

            return response()->json([
                'status' => 'success',
                'message'=>'Add comparision successfully',
                'data' => $this->compare_all_data_get($request),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'This listing already exists in comparison',
                'data' => $this->compare_all_data_get($request),
            ]);
        }
    }

    public function index(Request $request){


        $items = Compare::where('ip', $request->ip())->with('lists')->get();


        return view('frontend.compare', compact('items'));


    }

    private function compare_all_data_get($request){
        $inventoryItems = Compare::where('ip', $request->ip())->with('lists')->get();
        $html= '';
            foreach ($inventoryItems as $inventory) {

                $image = explode(',',$inventory->lists->image_from_url);
                $html .= '<div class="row p-0 m-0 compare-all">';
                $html .= '<div class="col-md-4 compare-photo">';

                $html .= '<img class="compare_image" style="margin-bottom:5px" src="' . $image[0] . '" alt="Inventory Image">';

                $html .= '</div>';
                $html .= '<div class="col-md-6 compare-details">';
                $html .= '<h6>' . $inventory->lists->title . '</h6>';
                $html .= '<h6>' . $inventory->lists->price_formate . '</h6>';
                $html .= '<h6>' .'#'  . $inventory->lists->stock . '</h6>';

                $html .= '</div>';
                $html .= '<div class="col-md-1">';
                $html .= '<td style="padding-left:-7px !important; color:white !important;"><a href="#" id="deleteComparision" class="" data-id="' . $inventory->id . '"><i style="margin-left:-10px !important; margin-top:-8px; color:red !important; font-size:20px;" class="fa fa-trash btn text-white"></i></a></td>';
                // $html .= '<i  class="fa fa-trash delete_comparision"></i>';
                $html .= '</div>';
                $html .= '</div>';


            }
            if (count($inventoryItems) > 0) {
                $html .= '<button class="btn btn-success" id="compare_data" type="button" style="margin-left:5px; margin-top:10px; margin-bottom:5px; border-radius:8px; padding:10px">Compare</button>';
            }
            return $html;

    }

    public function delete(Request $request){

        $com = Compare::find($request->id);
        $com->delete();

        return response()->json([
            'status'=>'success',
            'message'=>'comparision delete successfully',
            'data' => $this->compare_all_data_get($request),
        ]);
    }

}
