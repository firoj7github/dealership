<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ReportAdd;
use App\Models\Report;
use App\Models\ReportPhoto;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function reportAdd(ReportAdd $request)
    {
        try {
            $data = [
                'subscriber_id' => Auth::user()->subscriber_id,
                'donor_id' => $request->donor_id,
                'present_volunteer_id' => $request->present_volunteer_id,
                'responsible_volunteer_id' => $request->responsible_volunteer_id,
                'name_of_patient' => $request->name_of_patient,
                'name_of_hospital' => $request->name_of_hospital,
                'contact_number' => $request->contact_number,
                'description' => $request->description,
            ];

            $report = Report::create($data);
            $images = [];
            if (!empty($request->images)) {
                foreach ($request->images as $item) {
                    $image = uploadFile($item, reportImagePath());
                    $images[] = [
                        'report_id' => $report->id,
                        'image' => $image,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
            }

            if (!empty($images)) {
                ReportPhoto::insert($images);
            }

            return response()->json([
                'status' => true,
                'message' => 'Report has been added successfully',
                'data' => []
            ]);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again.',
                'data' => []
            ]);
        }
    }

    public function getReports(Request $request)
    {
        $user = Auth::user();
        $reports = Report::where(['subscriber_id' => $user->subscriber_id])
                    ->with('donor', 'presentVolunteer', 'responsibleVolunteer');
        $reports = $reports->paginate(200)->appends($request->all());
        $reports->each(function ($report) {
            $report->donor_name = $report->donor->name;
            $report->blood_group = bloodGroups($report->donor->blood_group);
            $report->donor_image = $report->donor->image ? asset(donorImageViewPath() . $report->donor->image) : "";
            $report->present_volunteer_name = empty($report->presentVolunteer) ? "" : $report->presentVolunteer->first_name . ' ' . $report->presentVolunteer->last_name;
            $report->responsible_volunteer_name = empty($report->responsibleVolunteer) ? "" : $report->responsibleVolunteer->first_name . ' ' . $report->responsibleVolunteer->last_name;
        });

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'reports' => $reports
            ]
        ]);
    }

    public function getVolunteerList(Request $request)
    {
        $user = Auth::user();
        if ($request->name) {
            $volunteers = User::select('id', 'first_name', 'last_name')->where(['subscriber_id' => $user->subscriber_id, 'role' => MEMBER_ROLE])->where('name', 'LIKE', "%$request->name%")->where(['status' => ACTIVE_STATUS]);
        } else {
            $volunteers = User::select('id', 'first_name', 'last_name')->where(['subscriber_id' => $user->subscriber_id, 'role' => MEMBER_ROLE])->where(['status' => ACTIVE_STATUS]);
        }
        $volunteers = $volunteers->paginate(200)->appends($request->all());

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'volunteers' => $volunteers
            ]
        ]);
    }
}
