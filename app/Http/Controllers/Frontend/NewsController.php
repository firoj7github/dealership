<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index(){

        $news= News::whereNull('deleted_at')->paginate(8);
        return view('frontend.news', compact('news'));
    }

    public function custom(){
        $news= News::all();
        return view('admin.news.news_management', compact('news'));
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'title' => 'required|string',
            'img' => 'required|mimes:jpeg,png,jpg,gif',
        ],[
            'description.required' => 'This field is required.',
            'title.required' => 'This field is required.',
            'img.required' => 'An image file is required.',
            'img.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        // return $request->file('img');
        $news = new News();
        if ($request->hasFile('img')) {
            $path = 'frontend/images/news/';
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($path), $imageName);
            $news->image = $imageName;
        }

        $news->title = $request->title;
        $news->description = $request->description;
        $news->save();
        return response()->json(['status' =>'success']);

    }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'up_description' => 'required|string',
            'up_title' => 'required|string',
        ],[
            'up_description.required' => 'This field is required.',
            'up_title.required' => 'This field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $news=News::find($request->news_id);

        if ($request->hasFile('up_img')) {
            $path = 'frontend/images/news/';
            $image = $request->file('up_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            if($image)
            {
                if ($news->image != null) {

                    unlink(public_path($path) . $news->image);
                    $image->move(public_path($path), $imageName);
                    $news->image = $imageName;
                } else {
                    $news->image = $news->image;
                }
            }


        }
        $news->title = $request->up_title;
        $news->description = $request->up_description;
        $news->save();



        return response()->json([
            'status'=>'success'
        ]);

    }

    public function delete(Request $request){


        $news =News::find($request->id);
        // $destination='frontend/images/news/'.$item->image;
        // if(File::exists( $destination)){
        //    File::delete($destination);
        // }
        // if ($news->image != null) {
        //     $path = 'frontend/images/news/';
        //     unlink(public_path($path) . $news->image);

        // }

        $news->delete();

        return response()->json([
            'status'=>'success'
        ]);

    }

    public function permanentDelete(Request $request){


        $news =News::find($request->id);
        // $destination='frontend/images/news/'.$item->image;
        // if(File::exists( $destination)){
        //    File::delete($destination);
        // }
        if ($news->image != null) {
            $path = 'frontend/images/news/';
            unlink(public_path($path) . $news->image);

        }

        $news->forceDelete();

        return response()->json([
            'status'=>'success'
        ]);

    }



    public function newsDetails($id){

        $single= News::find($id);
        // return $singlenews;
        $news = News::all();


        return view('frontend.news_details', compact('single','news'));


    }
    public function newsView(Request $request){


        $show= News::find($request->id);
        return response()->json(['show'=>$show]);





    }
}
