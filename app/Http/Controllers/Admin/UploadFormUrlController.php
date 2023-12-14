<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryMediaInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
// use Illuminate\Support\Str;

class UploadFormUrlController extends Controller
{


    public function downloadImageFromUrl(Request $request)
    {
        $inventories = Inventory::select('id','image_from_url','vin','stock','stock_date_formated')->orderBy('id','desc')->get();
        // $mediainfo_object = InventoryMediaInfo::select('id','thumbnail_img')->orderBy('id','desc');

        $mediainfo_query = InventoryMediaInfo::select('id','thumbnail_img');
        $mediainfo_object= $mediainfo_query->orderBy('id','desc');
        foreach ($inventories as $inventory) {
            $downloadedImageLinks = [];
            
            // dd($inventory->stock_date_formated,strtotime($inventory->stock_date_formated));
            $stockDate = date('mdY',strtotime($inventory->stock_date_formated));
            $stockId =  $inventory->stock;
            $directoryname = $stockDate.'_'.$stockId;
            $storage_path = 'frontend/images/inventory/'.$directoryname;

            $item = explode(',', $inventory->image_from_url);

            foreach ($item as $singleImage) {
                $url = $singleImage;
                $response = Http::get($url);

                
                if ($response->successful()) {
                    // Create an Intervention Image instance
                    $img = Image::make($response->body());
                    
                    // Resize the image
                    $img->resize(860, 484);
                    if (!File::exists($storage_path)) {
                        File::makeDirectory($storage_path, $mode = 0755, true, true);
                    }

                    $path = parse_url($url, PHP_URL_PATH);
                    $imageName = pathinfo($path, PATHINFO_BASENAME);
                    $save_url = $storage_path.'/'.$imageName;
                    $save = $img->save(public_path($save_url));

                    if (!$save) {
                        return response()->json(['msg' => 'error']);
                    }
                    $downloadedImageLinks[] = asset($save_url);
                } 
            }

            $plainText = implode(', ', $downloadedImageLinks);
            $mediainfor =InventoryMediaInfo::find($inventory->id);
            $mediainfor->thumbnail_img = $plainText ;
            $mediainfor->save();

        }

        return response()->json(['msg' => 'success']);
    }

}



    // public function __invoke(Request $request)
    // {
    //     $inventories =Inventory::all();

    //     foreach($inventories as $key => $inventory)
    //     {
    //         $inventory_data  =Inventory::find($inventory->id);

    //         $downloadedImageLinks = [];
    //         // dd($inventory);
    //         $item = explode(',', $inventory->image_from_url);
    //         // dd('skhfksdfjkd',count($item));
    //             foreach($item as  $singleImage)
    //             {
    //                 // use image download start here 
    //                 $url =$singleImage;
    //                 $imageContent = file_get_contents($url);
    //                 if($imageContent == false)
    //                 {
    //                     return response()->json(['msg' => 'error']);
    //                 }

    //                 $imageName = Str::random(60).".png";
    //                 // $save = file_put_contents(storage_path("app/public/$imageName"), $imageContent);
    //                 $save = file_put_contents(public_path("frontend/images/inventory/$imageName"), $imageContent);
    //                 if(!$save){
    //                     return response()->json(['msg' => 'error']);
    //                 }
    //                 $downloadedImageLinks[] = asset("frontend/images/inventory/$imageName");

    //             // dd($downloadedImageLinks);
    //             // Convert the array of downloaded image links to a comma-separated string
    //             // $downloadedImagesString = implode(',', $downloadedImageLinks);

    //             // Update the inventory record with the new field
    //             }
    //         }
    //         $plainText = implode(', ', $downloadedImageLinks); 
    //         $inventory_data->update(['downloaded_image_links' => $plainText]);

    //         // InventoryMediaInfo::
    //         // return $inventory_data;
    //     return response()->json(['msg' => 'success']);
    //     return response()->json(['url' => asset("frontend/images/inventory/$imageName")]);
    // }

    
    // public function downloadImageFromUrl(Request $request)
    // {
    //     $inventories = Inventory::select('id','image_from_url','vin','stock','stock_date_formated')->orderBy('id','desc')->get();
    //     // $mediainfo_object = InventoryMediaInfo::select('id','thumbnail_img')->orderBy('id','desc');

    //     $mediainfo_query = InventoryMediaInfo::select('id','thumbnail_img');
    //     $mediainfo_object= $mediainfo_query->orderBy('id','desc');
    //     foreach ($inventories as $inventory) {
    //         $downloadedImageLinks = [];
            
    //         // dd($inventory->stock_date_formated,strtotime($inventory->stock_date_formated));
    //         $stockDate = date('mdY',strtotime($inventory->stock_date_formated));
    //         $stockId =  $inventory->stock;
    //         $directoryname = $stockDate.'_'.$stockId;
    //         $storage_path = 'frontend/images/inventory/'.$directoryname;

    //         $item = explode(',', $inventory->image_from_url);

    //         foreach ($item as $singleImage) {
    //             $url = $singleImage;
    //             $imageContent = file_get_contents($url);

    //             if ($imageContent === false) {
    //                 return response()->json(['msg' => 'error']);
    //             }

    //             // Parse the URL to get the path
    //             $path = parse_url($url, PHP_URL_PATH);

    //             // //Use pathinfo to get the filename
    //             // $imageName = pathinfo($path, PATHINFO_FILENAME) . '.png';
    //             $imageName = pathinfo($path, PATHINFO_BASENAME);



    //             // $imageName = Str::random(60) . ".png";

    //             if (!File::exists($storage_path)) {
    //                 File::makeDirectory($storage_path, $mode = 0755, true, true);
    //             }

    //             $save_url = $storage_path.'/'.$imageName;
    //             $mediainfo = $mediainfo_object->find($inventory->id);

    //             // dd($mediainfo->thumbnail_img);
    //             // $explode_mediainfo = explode(',',$mediainfo->thumbnail_img);
                
    //             // foreach ($explode_mediainfo as $media) {
    //             //     $path_media = parse_url($url, PHP_URL_PATH);
    //             //     $imageName_media = pathinfo($path_media, PATHINFO_BASENAME);
    //             //     if($imageName_media != $imageName){
    //             //         return ' we are same bro';
    //             //     }
    //             // }

    //             // dd($mediainfo);
    //             $save = file_put_contents(public_path($save_url), $imageContent);

    //             if (!$save) {
    //                 return response()->json(['msg' => 'error']);
    //             }

    //             $downloadedImageLinks[] = asset($save_url);
    //         }

    //         $plainText = implode(', ', $downloadedImageLinks);

    //         $mediainfor =InventoryMediaInfo::find($inventory->id);
    //         $mediainfor->thumbnail_img = $plainText ;
    //         $mediainfor->save();

    //     }

    //     return response()->json(['msg' => 'success']);
    // }
