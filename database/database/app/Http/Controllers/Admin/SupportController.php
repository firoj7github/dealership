<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function supportMessageList(Request $request)
    {
        if ($request->ajax()) {
            $messages = ContactUs::whereHas('customer', function ($query) {
                $query->whereHas('user', function ($where) {
                    $where->where(['id' => Auth::id()]);
                });
            })->orderBy('read', 'asc')
                ->orderBy('created_at', 'desc');

            return datatables($messages)
                ->addColumn('message', function ($item) {
                    if ($item->read) {
                        $html = "<p>" . $item->message . "</p>";
                    } else {
                        $html = "<b>" . $item->message . "</b>";
                    }

                    return $html;
                })
                ->addColumn('action', function ($item) {
                    $html = '<ul class="activity-menu list-unstyled" style="display: inline-flex; margin-top: 18px">';
                            if ($item->read == 1) {
                                $html .= '<li>
                                            <a class="text-success mr-2 modal-trigger" href="#" data-toggle="modal" data-read="yes" data-target="#messageModal" data-placement="top" title="' . __('View Details') . '" data-link="' . route('admin.supportMessageRead', encrypt($item->id)) . '" data-contact-message="' . $item->message . '">
                                                <i class="nav-icon i-Eye-Visible font-weight-bold"></i>
                                            </a>
                                        </li>';
                            } else {
                                $html .= '<li>
                                            <a class="text-success mr-2 modal-trigger" href="#" data-toggle="modal" data-read="no" data-target="#messageModal" data-placement="top" title="' . __('View Details') . '" data-link="' . route('admin.supportMessageRead', encrypt($item->id)) . '" data-contact-message="' . $item->message . '">
                                                <i class="nav-icon i-Eye-Visible font-weight-bold"></i>
                                            </a>
                                        </li>';
                            }
                    $html .= '<li>
                                <a class="text-danger mr-2 confirmedDelete" href="#" data-link="' . route('admin.supportMessageDelete', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Delete') . '">
                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                </a>
                            </li>';

                    return $html;
                })
                ->rawColumns(['message', 'action'])
                ->make(true);
        }
        $data['mainMenu'] = 'support';
        $data['menuName'] = __('Support');

        return view('admin.contact_us.list', $data);
    }

    public function supportMessageRead($id)
    {
        try {
            $id = decrypt($id);
            $message = ContactUs::where('id', $id)->first();
            if (empty($message)) {
                return redirect()->back()->with(['error' => __("Message not found")]);
            }
            $message->read = 1;
            $message->update();

            return redirect()->back()->with(['success' => __('Message is marked as read')]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong. Please try again')]);
        }
    }

    public function supportMessageDelete($id)
    {
        try {
            $id = decrypt($id);
            $message = ContactUs::where('id', $id)->first();
            if (empty($message)) {
                return redirect()->back()->with(['error' => __("Message not found")]);
            }
            $message->delete();

            return redirect()->back()->with(['success' => __('Message is deleted successfully')]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong. Please try again')]);
        }
    }
}
