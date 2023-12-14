<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InstituteAddRequest;
use App\Http\Services\InstituteService;
use App\Imports\InstituteImport;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class InstituteController extends Controller
{
    public $service;

    function __construct()
    {
        $this->service = new InstituteService();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $institute = Institute::where('status', '!=', DELETE_STATUS);

            return datatables($institute)
                ->addColumn('status', function ($item) {
                    return instituteStatus($item->status);
                })
                ->addColumn('district', function ($item) {
                    return districts($item->district)['name'];
                })
                ->addColumn('action', function ($item) {
                    $html = '<ul class="activity-menu list-unstyled" style="display: inline-flex;">
                            <li>
                                <a class="text-success mr-2" href="' . route('admin.instituteEdit', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Edit') . '">
                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                </a>
                            </li>
                            <li>
                                <a class="text-danger mr-2 confirmedDelete" href="#" data-link="' . route('admin.instituteDelete', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Delete') . '">
                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                </a>
                            </li>';

                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['mainMenu'] = 'instituteList';
        $data['menuName'] = __('Institute List');

        return view('admin.institute.list', $data);
    }

    public function instituteAdd()
    {
        $data['mainMenu'] = 'instituteList';
        $data['menuName'] = __('Institute List');
        $data['buttonTitle'] = __('Add Institute');
        $data['title'] = __('Add Institute');

        return view('admin.institute.addEdit', $data);
    }

    public function instituteEdit($id)
    {
        try {
            $institute = $this->service->getById(decrypt($id));
            if (empty($institute)) {
                return redirect()->back()->with(['error' => __('Institute not found')]);
            }

            $data['mainMenu'] = 'instituteList';
            $data['menuName'] = __('Institute List');
            $data['item'] = $institute;
            $data['buttonTitle'] = __('Update');
            $data['title'] = __('Update Institute');

            return view('admin.institute.addEdit', $data);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function instituteAddProcess(InstituteAddRequest $request)
    {
        try {
            $data = [
                'subscriber_id' => Auth::user()->customer->subscriber->id,
                'name' => $request->name,
                'district' => $request->district,
                'upozila' => $request->upozila,
                'status' => $request->status,
            ];
            if ($request->id) {
                $this->service->update(['id' => $request->id], $data);

                return redirect()->back()->with(['success' => __('Institute has been updated successfully')]);
            } else {
                $this->service->create($data);

                return redirect()->route('admin.instituteList')->with(['success' => __('Institute has been added successfully')]);
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong') . $exception->getMessage()]);
        }
    }

    public function instituteDelete($id)
    {
        try {
            $id = decrypt($id);
            $this->service->delete($id);

            return redirect()->back()->with(['success' => __('Institute has been deleted successfully')]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function addInstituteFromExcel(Request $request)
    {
        try {
            Excel::import(new InstituteImport($request->district, $request->upozila), $request->file('file'));

            return redirect()->route('admin.instituteList')->with(['success' => __('Institute has been added successfully')]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong') . $exception->getMessage()]);
        }
    }

    public function getInstitutes(Request $request)
    {
//        $institute = Institute::where('status', '!=', DELETE_STATUS)->where('district', $request->district)->where('upozila', $request->upozila)->get();
        $institute = Institute::where('status', '!=', DELETE_STATUS)->get();

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => [
                'institutes' => $institute
            ]
        ]);
    }
}
