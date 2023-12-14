<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Repository\SubscriberRepository;
use App\Http\Requests\SuperAdmin\CustomerRequest;
use App\Http\Services\CustomerService;
use App\Models\Subscriber;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CustomerController extends Controller
{
    public $service;

    function __construct()
    {
        $this->service = new CustomerService();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customer = Subscriber::where('status', '!=', DELETE_STATUS)->with(['customer', 'subscriptionPackage']);

            return datatables($customer)
                ->addColumn('status', function ($item) {
                    return customerStatus($item->status);
                })
                ->addColumn('email', function ($item) {
                    return isset($item->customer->user) ? $item->customer->user->email : '';
                })
                ->addColumn('user_name', function ($item) {
                    return isset($item->customer->user) ? $item->customer->user->user_name : '';
                })
                ->addColumn('subscription_package', function ($item) {
                    return isset($item->subscriptionPackage) ? $item->subscriptionPackage->name : '';
                })
                ->addColumn('action', function ($item) {
                    $html = '<ul class="activity-menu list-unstyled" style="display: inline-flex;">
                                <li>
                                    <a class="text-success mr-2" href="' . route('superAdmin.customerEdit', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Edit') . '">
                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-danger mr-2 confirmedDelete" href="#" data-link="' . route('superAdmin.customerDelete', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Delete') . '">
                                        <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                    </a>
                                </li>';

                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['mainMenu'] = 'customerList';
        $data['menuName'] = __('Customer List');

        return view('super_admin.customers.list', $data);
    }

    public function customerAdd()
    {
        $data['mainMenu'] = 'customerList';
        $data['menuName'] = __('Customer List');
        $data['buttonTitle'] = __('Add Customer');
        $data['title'] = __('Add Customer');

        return view('super_admin.customers.addEdit', $data);
    }

    public function customerEdit($id)
    {
        try {
            $subscriberRepo = new SubscriberRepository();
            $customer = $subscriberRepo->getById(decrypt($id));
            if (empty($customer)) {
                return redirect()->back()->with(['error' => __('Customer not found')]);
            }

            $data['mainMenu'] = 'customerList';
            $data['menuName'] = __('Customer List');
            $data['item'] = $customer;
            $data['buttonTitle'] = __('Update');
            $data['title'] = __('Update Customer');

            return view('super_admin.customers.addEdit', $data);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function customerAddProcess(CustomerRequest $request)
    {
        $start = new DateTime($request->start_date);
        $end    = new DateTime($request->end_date);
        if (!empty($request->end_date) && ($end <= $start)) {
            return redirect()->back()->with(['error' => __('Subscription end date must be greater than start date')])->withInput();
        }
        try {
            if ($request->id) {
                $response = $this->service->updateCustomer(['id' => $request->id], $request->except('_token'));

                if ($response['status']) {
                    return redirect()->back()->with(['success' => $response['message']]);
                }
            } else {
                $response = $this->service->createCustomer($request->except('_token'));

                if ($response['status']) {
                    return redirect()->route('superAdmin.customerList')->with(['success' => $response['message']]);
                }
            }

            return redirect()->back()->with(['error' => $response['message']])->withInput();
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')])->withInput();
        }
    }

    public function customerDelete($id)
    {
        try {
            $id = decrypt($id);
            $customerDelete = $this->service->deleteCustomer($id);

            if ($customerDelete['status']) {
                return redirect()->back()->with(['success' => $customerDelete['message']]);
            }

            return redirect()->back()->with(['error' => $customerDelete['message']]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }
}
