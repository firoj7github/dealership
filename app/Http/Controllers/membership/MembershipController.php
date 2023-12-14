<?php

namespace App\Http\Controllers\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Membership\CreateMembershipRequest;
use App\Http\Requests\Membership\UpdateMembershipRequest;
use App\Interface\MembershipServiceInterface;
use App\Models\Membership;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class MembershipController extends Controller
{
    public function __construct(protected MembershipServiceInterface $membershipService)
    {

    }
    public function index(Request $request){

        $memberships= $this->membershipService->all();

        if ($request->ajax()) {
            return DataTables::of($memberships)
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


                    ->addColumn('status', function ($row) {
                        $html = "<select class='action-select " . ($row->status == 1 ? 'bg-success' : '') . " membership_status form-control' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id'>
                                    <option " . ($row->status == 1 ? 'selected' : '') . " value='1'>Active</option>
                                    <option " . ($row->status == 0 ? 'selected' : '') . " value='0'>Inactive</option>
                                </select>";
                        return $html;
                    })

                    ->addColumn('action', function ($row) {
                        $html = '<a href="#" data-bs-toggle="modal" data-bs-target="#membershipEdit" class="btn btn-sm btn-success edit_membership text-white"
                                    data-id="' . $row->id . '" data-membership_type="' . $row->membership_type . '" data-membership_price="' . $row->membership_price . '"
                                    data-status="' . $row->status .'" title="Edit"> <i class="fa fa-edit"></i> </a>' .
                                ' <a class="btn btn-sm btn-warning delete text-white delete_member" data-id="' . $row->id . '" title="Archive"> <i class="fa fa-delete-left"></i></a>'.
                                ' <a class="btn btn-sm btn-danger permanent_delete text-white " data-id="' . $row->id . '" title="Delete"> <i class="fa fa-trash"></i></a>';
                        return $html;
                    })
                    ->rawColumns(['action','check','status'])
                    ->make(true);
        }

        return view('admin.monetization.membership', compact('memberships'));
    }
    public function add(Request $request){

        $validator = Validator::make($request->all(), [
            'membership_price' => 'required',
            'membership_type' => 'required',
            'status' => 'required',
        ], [
            'membership_price.required' => 'This field is required.',
            'membership_type.required' => 'This field is required.',
            'status.required' => 'This field is required.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $this->membershipService->store($request->all());

        return response()->json(['status' =>'success']);

    }

    // public function update(UpdateMembershipRequest $request, $id){
    //     $this->membershipService->update($request->validated(), $id);

    //     return response()->json([
    //         'status'=>'success'
    //     ]);


    // }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'up_membership_price' => 'required',
            'up_membership_type' => 'required',
            'up_status' => 'required',
        ], [
            'up_membership_price.required' => 'This field is required.',
            'up_membership_type.required' => 'This field is required.',
            'up_status.required' => 'This field is required.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $member= Membership::find($request->membership_id);
        $member->membership_type = $request->up_membership_type;
        $member->membership_price = $request->up_membership_price;
        $member->status = $request->up_status;
        $member->save();

        return response()->json([
            'status'=>'success'
        ]);


    }

    public function delete(Request $request){
        $member= Membership::find($request->id);
        $member->delete();
        return response()->json([
            'status'=>'success'
        ]);

    }
    public function permanentDelete(Request $request){
        $member= Membership::find($request->id);
        $member->forceDelete();
        return response()->json([
            'status'=>'success'
        ]);

    }

    public function monetizationAjax(Request $request)
    {
        try {

            $membershipStatus = Membership::find($request->id);
            $membershipStatus->status = $request->status === '1' ? 1 : 0;
            $membershipStatus->save();
            return response()->json(['status' => 'success', 'message' => 'Status Change Successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

}
