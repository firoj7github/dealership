<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DonorAddRequest;
use App\Models\Donor;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorController extends Controller
{
    public function addBloodDonor(DonorAddRequest $request)
    {
        if (empty(districts($request->district))) {
            return response()->json([
                'success' => false,
                'message' => __('Invalid district'),
                'data' => []
            ]);
        }

        $hasPhone = Donor::where(['phone' => $request->phone, 'subscriber_id' => $request->subscriber_id])->first();
        if (!empty($hasPhone)) {
            return [
                'success' => false,
                'message' => __('This phone number is already used'),
                'data' => null
            ];
        }

        try {
            $image = null;
            if (!empty($request->image)) {
                $image = uploadFile($request->image, donorImagePath());
            }
            if (!is_numeric($request->institution)) {
                $data = [
                    'name' => $request->institution,
                    'district' => $request->district,
                    'upozila' => $request->upozila,
                    'status' => ACTIVE_STATUS,
                ];
                $institute = Institute::create($data);
                $instituteId = $institute->id;
            } else {
                $instituteId = $request->institution;
            }
            Donor::create([
                'subscriber_id' => $request->subscriber_id,
                'added_by' => Auth::id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'blood_group' => $request->blood_group,
                'district' => $request->district,
                'upozila' => $request->upozila,
                'last_blood_donate_date' => $request->last_blood_donate_date,
                'gender' => $request->gender,
                'institution' => $instituteId,
                'image' => $image
            ]);

            return response()->json([
                'success' => true,
                'message' => __('Donor is added successfully'),
                'data' => []
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => __('Something went wrong. Please try again') . $exception->getMessage(),
                'data' => []
            ]);
        }
    }

    public function getDonorList(Request $request)
    {
        $user = Auth::user();
        if ($request->donor) {
            $donors = Donor::where(['subscriber_id' => $user->subscriber_id])->where('name', 'LIKE', "%$request->donor%")->where(['status' => ACTIVE_STATUS])->with('addedBy', 'institutionName');
        } else {
            $donors = Donor::where(['subscriber_id' => $user->subscriber_id])->where(['status' => ACTIVE_STATUS])->with('addedBy', 'institutionName');
        }
        $donors = $donors->paginate(200)->appends($request->all());

        $donors->each(function ($donor) {
            $donor->blood_group = bloodGroups($donor->blood_group);
            $donor->gender = genders($donor->gender);
            $donor->district = districts($donor->district)['name'];
            $donor->upozila = upozila($donor->upozila)['name'];
            $donor->eligible = checkEligibilityToDonateBlood($donor->last_blood_donate_date);
            $donor->added_by_name = $donor->addedBy->first_name . ' ' . $donor->addedBy->last_name;
            $donor->institution_name = isset($donor->institutionName) ? $donor->institutionName->name : "";
            $donor->unsetRelation('addedBy')->unsetRelation('institutionName');
        });
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'donors' => $donors
            ]
        ]);
    }

    public function getInstitute(Request $request)
    {
        if (empty($request->district)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid district',
                'data' => null
            ]);
        }

        if (empty($request->upozila)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid upozila',
                'data' => null
            ]);
        }

        $institutes = Institute::select('id', 'name')->where('district', $request->district)->where('upozila', $request->upozila)->where(['status' => ACTIVE_STATUS])->where('name', 'LIKE', "%$request->name%")->get();

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => ['institutes' => $institutes]
        ]);
    }

    public function getEligibleDonorList(Request $request)
    {
        $user = Auth::user();
        $now = \Carbon\Carbon::now()->format("Y-m-d");
        if ($request->donor) {
            $donors = Donor::where(['subscriber_id' => $user->subscriber_id])->whereRaw('last_blood_donate_date + interval 90 day < "' . $now . '"')->where('name', 'LIKE', "%$request->donor%")->where(['status' => ACTIVE_STATUS]);
        } else {
            $donors = Donor::where(['subscriber_id' => $user->subscriber_id])->whereRaw('last_blood_donate_date + interval 90 day < "' . $now . '"')->where(['status' => ACTIVE_STATUS]);
        }
        $donors = $donors->paginate(200)->appends($request->all());

        $donors->each(function ($donor) {
            $donor->blood_group = bloodGroups($donor->blood_group);
            $donor->district = districts($donor->district)['name'];
            $donor->eligible = checkEligibilityToDonateBlood($donor->last_blood_donate_date);
        });
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'donors' => $donors
            ]
        ]);
    }
}
