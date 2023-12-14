<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceAddRequest;
use App\Http\Services\ServiceProcessService;
use App\Models\Clinic;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public $service;

    function __construct()
    {
        $this->service = new ServiceProcessService();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $service = Service::with('service')->whereHas('clinic', function ($clinic) use ($id) {
                $clinic->where('id', decrypt($id));
            })->where('status', '!=', DELETE_STATUS);

            return datatables($service)
                ->addColumn('parent_category', function ($item) {
                    return isset($item->service) ? $item->service->title : '';
                })
                ->addColumn('status', function ($item) {
                    return serviceStatus($item->status);
                })
                ->addColumn('image', function ($item) {
                    $url = empty($item->image) ? '' : asset(serviceImageViewPath() . $item->image);
                    return '<img src="' . $url . '" width="100" height="10" style="max-width: 800px; height: 100px;" alt="No image found">';
                })
                ->addColumn('action', function ($item) use ($id){
                    $html = '<ul class="activity-menu list-unstyled" style="display: inline-flex;">
                                <li>
                                    <a class="text-success mr-2" href="' . route('admin.serviceEdit', ['id' => encrypt($item->id), 'location_id' => $id]) . '" data-toggle="tooltip" data-placement="top" title="' . __('Edit') . '">
                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-danger mr-2 confirmedDelete" href="#" data-link="' . route('admin.serviceDelete', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Delete') . '">
                                        <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                    </a>
                                </li>';

                    return $html;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        } else {
            $id = decrypt($request->id);
        }
        $data['mainMenu'] = 'locationList';
        $data['subMenu'] = 'service';
        $data['subMenuName'] = __('Service');
        $data['menuName'] = __('Location Details');
        $data['locationId'] = $id;

        return view('admin.services.list', $data);
    }

    public function serviceAdd(Request $request)
    {
        $data['mainMenu'] = 'locationList';
        $data['buttonTitle'] = __('Add Service');
        $data['title'] = __('Add Service');
        $data['subMenu'] = 'service';
        $data['subMenuName'] = __('Service');
        $data['menuName'] = __('Location Details');
        $data['locationId'] = decrypt($request->location_id);

        return view('admin.services.addEdit', $data);
    }

    public function serviceEdit(Request $request, $id)
    {
        try {
            $service = $this->service->getById(decrypt($id));
            if (empty($service)) {
                return redirect()->back()->with(['error' => __('Service not found')]);
            }

            $data['mainMenu'] = 'locationList';
            $data['item'] = $service;
            $data['buttonTitle'] = __('Update');
            $data['title'] = __('Update Service');
            $data['subMenu'] = 'service';
            $data['subMenuName'] = __('Service');
            $data['menuName'] = __('Location Details');
            $data['locationId'] = decrypt($request->location_id);

            return view('admin.services.addEdit', $data);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function serviceAddProcess(ServiceAddRequest $request)
    {
        try {
            $clinic = Clinic::whereHas('customer', function ($query) {
                $query->whereHas('user', function ($where) {
                    $where->where(['id' => Auth::id()]);
                });
            })->where(['id' => $request->clinic_id, 'status' => ACTIVE_STATUS])->first();
            if (empty($clinic)) {
                return redirect()->back()->with(['error' => __('Invalid location')]);
            }

            if ($request->service_id) {
                $service = Service::whereHas('clinic', function ($whereHas) {
                    $whereHas->whereHas('customer', function ($query) {
                        $query->whereHas('user', function ($where) {
                            $where->where(['id' => Auth::id()]);
                        });
                    })->where(['status' => ACTIVE_STATUS]);;
                })->where(['id' => $request->service_id, 'status' => ACTIVE_STATUS])->first();

                if (empty($service)) {
                    return redirect()->back()->with(['error' => __('Invalid service')]);
                }
            }

            if ($request->id) {
                $updateData = [
                    'clinic_id' => $request->clinic_id,
                    'parent_service_id' => $request->get('service_id', null),
                    'title' => $request->name,
                    'status' => $request->status
                ];
                if (!empty($request->image)) {
                    $image = uploadFile($request->image, serviceImagePath());
                    $updateData['image'] = $image;
                }
                $this->service->update(['id' => $request->id], $updateData);

                return redirect()->back()->with(['success' => __('Service has been updated successfully')]);
            } else {
                $image = '';
                if (!empty($request->image)) {
                    $image = uploadFile($request->image, serviceImagePath());
                }
                $this->service->create([
                    'clinic_id' => $request->clinic_id,
                    'parent_service_id' => $request->get('service_id', null),
                    'title' => $request->name,
                    'image' => $image,
                    'status' => $request->status
                ]);

                return redirect()->route('admin.serviceList', ['id' => encrypt($request->clinic_id)])->with(['success' => __('Service has been added successfully')]);
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong') . $exception->getMessage()]);
        }
    }

    public function serviceDelete($id)
    {
        try {
            $id = decrypt($id);
            $this->service->delete($id);

            return redirect()->back()->with(['success' => __('Service has been deleted successfully')]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function getServiceNameList(Request $request)
    {
        $data = serviceList($request->clinic_id, $request->service_id);

        return response()->json(['data' => $data]);
    }
}
