<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\LeadMessage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function message()
    {
        $leads = LeadMessage::with('lead','user','receiver')->get()->unique('lead_id');
        // ->unique('name')
        return view('admin.message.all-message',compact('leads'));
    }
    public function show(Request $request){


        $messages = LeadMessage::with('user')->where('lead_id',$request->lead_id)->get();
            return response()->json([
                'status'=>'success',
                'data'=>$messages,
            ]);



    }


    public function delete(Request $request)
    {
        $message =LeadMessage::find($request->id);
        $message->delete();
        return response()->json(['status' => 'success', 'message' => 'Archive Successfully']);
    }


    public function archiveMessage(Request $request)
    {
        $message =ContactMessage::find($request->id);
        $message->delete();
        return response()->json(['status' => 'success', 'message' => 'Archive Successfully']);
    }

    public function adminContactMessagePermanentDelete(Request $request)
    {
        $message =ContactMessage::find($request->id);
        $message->forceDelete();
        return response()->json(['status' => 'success', 'message' => 'Delete Successfully']);
    }

    public function permanentDelete(Request $request)
    {
        $message =LeadMessage::find($request->id);
        $message->forceDelete();
        return response()->json(['status' => 'success', 'message' => 'Delete Successfully']);
    }

    public function ShowMessage()
    {
        $messages = ContactMessage::orderBy('id','desc')->get();
        return view('admin.message.index',compact('messages'));
    }
    public function statusUpdate(Request $request)
    {
        $message =ContactMessage::find($request->id);
        $message->status = 1;
        $message->save();

    }
}
