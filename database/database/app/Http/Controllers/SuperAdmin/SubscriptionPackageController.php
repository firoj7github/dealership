<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\SubscriptionPackageCreateRequest;
use App\Http\Services\SubscriptionPackageService;
use App\Models\Subscriber;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionPackageController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new SubscriptionPackageService();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $package = SubscriptionPackage::select('subscription_packages.*', 'sb.subscription_package_id as is_subscribed')
                ->leftJoin(DB::raw("(select subscription_package_id from subscribers group by subscription_package_id) sb"), 'subscription_packages.id', 'sb.subscription_package_id')
                ->where('status', '!=', DELETE_STATUS);

            return datatables($package)
                ->addColumn('status', function ($item) {
                    return subscriptionPackageStatus($item->status);
                })
                ->addColumn('action', function ($item) {
                    if (is_null($item->is_subscribed)) {
                        $editButton = '<ul class="activity-menu list-unstyled" style="display: inline-flex;">
                                <li>
                                    <a class="text-success mr-2" href="' . route('superAdmin.subscriptionPackageEdit', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Edit') . '">
                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                    </a>
                                </li>';
                        $deleteButton = '<li>
                                        <a class="text-danger mr-2 confirmedDelete" href="#" data-link="' . route('superAdmin.subscriptionPackageDelete', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Delete') . '">
                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                        </a>
                                    </li>';
                    } else {
                        $deleteButton = '';
                        $editButton = '';
                    }


                    return $editButton . $deleteButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['mainMenu'] = 'subscriptionPackageList';
        $data['menuName'] = __('Subscription Package List');

        return view('super_admin.subscription_packages.list', $data);
    }

    public function subscriptionPackageAdd()
    {
        $data['mainMenu'] = 'subscriptionPackageList';
        $data['menuName'] = __('Subscription Package List');
        $data['buttonTitle'] = __('Add Package');
        $data['title'] = __('Add Subscription Package');

        return view('super_admin.subscription_packages.addEdit', $data);
    }

    public function subscriptionPackageEdit($id)
    {
        try {
            $package = $this->service->getById(decrypt($id));
            if (empty($package)) {
                return redirect()->back()->with(['error' => __('Subscription package not found')]);
            }

            $data['mainMenu'] = 'subscriptionPackageList';
            $data['menuName'] = __('Subscription Package List');
            $data['item'] = $package;
            $data['buttonTitle'] = __('Update');
            $data['title'] = __('Update Subscription Package');

            return view('super_admin.subscription_packages.addEdit', $data);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function subscriptionPackageAddProcess(SubscriptionPackageCreateRequest $request)
    {
        try {
            if ($request->id) {
                $package = $this->service->getById($request->id);
                if (empty($package)) {
                    return redirect()->back()->with(['error' => __('No package found')]);
                }
            }

            if ($request->id) {
                $this->service->update(['id' => $request->id], $request->except('_token'));

                return redirect()->back()->with(['success' => __('Subscription package has been updated successfully')]);
            } else {
                $this->service->create($request->except('_token'));

                return redirect()->route('superAdmin.subscriptionPackageList')->with(['success' => __('Subscription package has been added successfully')]);
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function subscriptionPackageDelete($id)
    {
        try {
            $id = decrypt($id);
            $package = $this->service->getById($id);
            if (empty($package)) {
                return redirect()->back()->with(['error' => __('Subscription package not found')]);
            }
            $this->service->delete($id);

            return redirect()->back()->with(['success' => __('Subscription package has been deleted successfully')]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }
}
