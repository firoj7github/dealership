<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserAddRequest;
use App\Http\Services\UserService;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Subscriber;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public $service;

    function __construct()
    {
        $this->service = new UserService();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::whereHas('subscriber', function ($query) {
                $query->whereHas('customer', function ($where) {
                    $where->whereHas('user', function ($user) {
                        $user->where(['id' => Auth::id()]);
                    });
                });
            })->where('status', '!=', DELETE_STATUS);

            return datatables($user)
                ->addColumn('status', function ($item) {
                    return userStatus($item->status);
                })
                ->editColumn('first_name', function ($item) {
                    return $item->first_name . ' ' . $item->last_name;
                })
                ->addColumn('action', function ($item) {
                    $html = '<ul class="activity-menu list-unstyled" style="display: inline-flex;">
                                <li>
                                    <a class="text-info mr-2" href="' . route('admin.userView', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('View') . '">
                                        <i class="nav-icon i-Eye-Visible font-weight-bold"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-danger mr-2 confirmedDelete" href="#" data-link="' . route('admin.userDelete', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Delete') . '">
                                        <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                    </a>
                                </li>';

                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data['mainMenu'] = 'userList';
        $data['menuName'] = __('User List');

        return view('admin.users.list', $data);
    }

    public function userAdd()
    {
        $data['mainMenu'] = 'userList';
        $data['subMenu'] = 'Add User';
        $data['menuName'] = __('User List');
        $data['subMenuName'] = __('Add User');
        $data['buttonTitle'] = __('Add User');
        $data['title'] = __('Add User');

        return view('admin.users.addEdit', $data);
    }

    public function userEdit($id)
    {
        try {
            $user = $this->service->getById(decrypt($id));
            if (empty($user)) {
                return redirect()->back()->with(['error' => __('User not found')]);
            }
            $user->name = $user->first_name . ' ' . $user->last_name;

            $data['mainMenu'] = 'userList';
            $data['item'] = $user;
            $data['buttonTitle'] = __('Update');
            $data['subMenu'] = 'User Edit';
            $data['menuName'] = __('User List');
            $data['subMenuName'] = __('Update User');
            $data['userId'] = decrypt($id);
            $data['title'] = __('Update User');

            return view('admin.users.addEdit', $data);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function userView($id)
    {
        try {
            $user = $this->service->getById(decrypt($id));
            if (empty($user)) {
                return redirect()->back()->with(['error' => __('User not found')]);
            }
            $user->name = $user->first_name . ' ' . $user->last_name;

            $data['mainMenu'] = 'userList';
            $data['item'] = $user;
            $data['subMenu'] = 'User View';
            $data['menuName'] = __('User List');
            $data['subMenuName'] = __('User View');
            $data['userId'] = decrypt($id);
            $data['title'] = __('View User');

            return view('admin.users.view', $data);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function userAddProcess(UserAddRequest $request)
    {
        if (!empty($request->email) && !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->withInput()->with(['error' => __('Invalid email address')]);
        }
        $name = explode(' ', $request->name);
        try {
            $customer = Customer::where('user_id', Auth::id())->first();
            $subscriber = Subscriber::where(['customer_id' => $customer->id])->first();
            if ($request->id) {
                $hasPhone = User::where(['phone' => $request->phone, 'subscriber_id' => $subscriber->id])->where('id', '!=', $request->id)->first();
                if (!empty($hasPhone)) {
                    return redirect()->back()->withInput()->with(['error' => __('This phone number is already used')]);
                }
                $this->service->update(['id' => $request->id], [
                    'first_name' => isset($name[0]) ? $name[0] : "",
                    'last_name' => isset($name[1]) ? $name[1] : "",
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'zip_code' => $request->zip_code,
                    'city' => $request->city,
                    'country' => $request->country,
                    'status' => $request->status
                ]);

                return redirect()->route('admin.userView', ['id' => encrypt($request->id)])->with(['success' => __('User has been updated successfully')]);
            } else {
                $hasPhone = User::where(['phone' => $request->phone, 'subscriber_id' => $subscriber->id])->first();
                if (!empty($hasPhone)) {
                    return redirect()->back()->withInput()->with(['error' => __('This phone number is already used')]);
                }
                $randNum = randomNumber(10);

                $this->service->create([
                    'subscriber_id' => $subscriber->id,
                    'first_name' => isset($name[0]) ? $name[0] : "",
                    'last_name' => isset($name[1]) ? $name[1] : "",
                    'email' => $request->email,
                    'password' => Hash::make($randNum),
                    'role' => USER_ROLE,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'zip_code' => $request->zip_code,
                    'city' => $request->city,
                    'country' => $request->country,
                    'status' => $request->status
                ]);

                return redirect()->route('admin.userList')->with(['success' => __('User has been added successfully')]);
            }
        } catch (\Exception $exception) {
            return redirect()->back()->withInput()->with(['error' => __('Something went wrong') . $exception->getMessage()]);
        }
    }

    public function userDelete($id)
    {
        try {
            $id = decrypt($id);
            $this->service->deleteUser($id);

            return redirect()->back()->with(['success' => __('User has been deleted successfully')]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function userAppointmentList(Request $request)
    {
        if ($request->ajax()) {
            $appointment = Appointment::with('user', 'clinic', 'service', 'doctor')
                            ->where('user_id', $request->user)
                            ->where('status', '!=', DELETE_STATUS);

            return datatables($appointment)
                ->addColumn('status', function ($item) {
                    return appointmentStatus($item->status);
                })
                ->addColumn('first_name', function ($item) {
                    return isset($item->user) ? $item->user->first_name . ' ' . $item->user->last_name : "";
                })
                ->addColumn('phone', function ($item) {
                    return isset($item->user) ? $item->user->phone : "";
                })
                ->addColumn('clinic', function ($item) {
                    return isset($item->clinic) && isset($item->clinic->customer) ? $item->clinic->name : "";
                })
                ->addColumn('service', function ($item) {
                    return isset($item->service) ? $item->service->title: "";
                })
                ->addColumn('calendar', function ($item) {
                    return isset($item->doctor) ? $item->doctor->name : "";
                })
                ->addColumn('schedule', function ($item) {
                    return $item->scheduled_at;
                })
                ->addColumn('action', function ($item) {
                    $html = '<ul class="activity-menu list-unstyled" style="display: inline-flex;">
                            <li>
                                <a class="text-success mr-2" href="' . route('admin.appointmentEdit', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Edit') . '">
                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                </a>
                            </li>';

                    return $html;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data['mainMenu'] = 'userList';
        $data['subMenu'] = 'User Appointments';
        $data['menuName'] = __('User List');
        $data['subMenuName'] = __('User Appointments');
        $data['userId'] = $request->user;
        $data['title'] = __('View User Appointments');

        return view('admin.users.appointment-view', $data);
    }

    public function getUserList(Request $request)
    {
        $users = User::select(['first_name', 'last_name', 'phone'])
            ->whereHas('subscriber', function ($subscriber) {
                $subscriber->whereHas('customer', function ($where) {
                    $where->whereHas('user', function ($user) {
                        $user->where(['id' => Auth::id()]);
                    });
                });
            })
            ->where(function ($query) use($request) {
                $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
            })
            ->where('status', '!=', DELETE_STATUS)
            ->get();

        $users->each(function ($user) {
            $user->name = $user->first_name . ' ' . $user->last_name . ' | ' . $user->phone;
        });

        return response()->json([
            'status' => true,
            'data' => [
                'users' => $users
            ]
        ]);
    }
}
