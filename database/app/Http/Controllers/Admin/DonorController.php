<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DonorAddRequest;
use App\Http\Services\DonorService;
use App\Models\Donor;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorController extends Controller
{
    public $service;

    function __construct()
    {
        $this->service = new DonorService();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $donor = Donor::where('subscriber_id', Auth::user()->customer->subscriber->id)->where('status', '!=', DELETE_STATUS);
            if ($request->donor) {
                $donor = $donor->where('blood_group', $request->donor);
            }

            return datatables($donor)
                ->addColumn('status', function ($item) {
                    return donorStatus($item->status);
                })
                ->addColumn('blood_group', function ($item) {
                    return bloodGroups($item->blood_group);
                })
                ->addColumn('eligible', function ($item) {
                    $status = checkEligibilityToDonateBlood($item->last_blood_donate_date);

                    return $status ? "Yes" : "No";
                })
                ->addColumn('action', function ($item) {
                    $html = '<ul class="activity-menu list-unstyled" style="display: inline-flex; margin-top: 18px">
                            <li>
                                <a class="text-success mr-2" href="' . route('admin.donorEdit', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Edit') . '">
                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                </a>
                            </li>
                            <li>
                                <a class="text-danger mr-2 confirmedDelete" href="#" data-link="' . route('admin.donorDelete', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Delete') . '">
                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                </a>
                            </li>';

                    return $html;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        $data['mainMenu'] = 'donorList';
        $data['menuName'] = __('Donor List');

        return view('admin.donor.list', $data);
    }

    public function donorAdd()
    {
        $data['mainMenu'] = 'donorList';
        $data['menuName'] = __('Donor List');
        $data['buttonTitle'] = __('Add Donor');
        $data['title'] = __('Add Donor');
         $institute = Institute::all();
        $data['institute'] = $institute;


        return view('admin.donor.addEdit', $data);
    }

    public function donorEdit($id)
    {
        try {
            $donor = $this->service->getById(decrypt($id));
            if (empty($donor)) {
                return redirect()->back()->with(['error' => __('Donor not found')]);
            }

            $data['mainMenu'] = 'donorList';
            $data['menuName'] = __('Donor List');
            $data['item'] = $donor;
            $data['buttonTitle'] = __('Update');
            $data['title'] = __('Update Donor');
            $institute = Institute::all();
            $data['institute'] = $institute;

            return view('admin.donor.addEdit', $data);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function donorAddProcess(DonorAddRequest $request)
    {
        try {
            $data = [
                'subscriber_id' => Auth::user()->customer->subscriber->id,
                'added_by' => Auth::id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'blood_group' => $request->blood_group,
                'district' => $request->district,
                'upozila' => $request->upozila,
                'last_blood_donate_date' => $request->last_blood_donate_date,
                'gender' => $request->gender,
                'institution' => $request->institution,
                'status' => $request->status,
            ];
            $image = null;
            if (!empty($request->image)) {
                $image = uploadFile($request->image, donorImagePath());
            }
            $data['image'] = $image;
            if ($request->id) {
                $this->service->update(['id' => $request->id], $data);

                return redirect()->back()->with(['success' => __('Donor has been updated successfully')]);
            } else {
                $this->service->create($data);

                return redirect()->route('admin.donorList')->with(['success' => __('Donor has been added successfully')]);
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong') . $exception->getMessage()]);
        }
    }

    public function donorDelete($id)
    {
        try {
            $id = decrypt($id);
            $this->service->delete($id);

            return redirect()->back()->with(['success' => __('Donor has been deleted successfully')]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }
}
