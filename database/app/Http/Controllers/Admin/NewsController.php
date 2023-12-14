<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsAddRequest;
use App\Http\Services\NewsService;
use App\Models\Customer;
use App\Models\NewsFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public $service;

    function __construct()
    {
        $this->service = new NewsService();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $news = NewsFeed::whereHas('customer', function ($query) {
                            $query->whereHas('user', function ($where) {
                                $where->where(['id' => Auth::id()]);
                            });
                    })->where('status', '!=', DELETE_STATUS);

            return datatables($news)
                ->addColumn('status', function ($item) {
                    return newsStatus($item->status);
                })
                ->addColumn('image', function ($item) {
                    $url = empty($item->image) ? '' : asset(newsImageViewPath() . $item->image);

                    return '<img src="' . $url . '" width="100" height="10" style="max-width: 800px; height: 100px;" alt="No image found">';
                })
                ->addColumn('action', function ($item) {
                    $html = '<ul class="activity-menu list-unstyled" style="display: inline-flex; margin-top: 18px">
                            <li>
                                <a class="text-success mr-2" href="' . route('admin.newsEdit', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Edit') . '">
                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                </a>
                            </li>
                            <li>
                                <a class="text-danger mr-2 confirmedDelete" href="#" data-link="' . route('admin.newsDelete', encrypt($item->id)) . '" data-toggle="tooltip" data-placement="top" title="' . __('Delete') . '">
                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                </a>
                            </li>';

                    return $html;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        $data['mainMenu'] = 'newsList';
        $data['menuName'] = __('News List');

        return view('admin.news_feeds.list', $data);
    }

    public function newsAdd()
    {
        $data['mainMenu'] = 'newsList';
        $data['menuName'] = __('News List');
        $data['buttonTitle'] = __('Add News');
        $data['title'] = __('Add News');

        return view('admin.news_feeds.addEdit', $data);
    }

    public function newsEdit($id)
    {
        try {
            $news = $this->service->getById(decrypt($id));
            if (empty($news)) {
                return redirect()->back()->with(['error' => __('News not found')]);
            }

            $data['mainMenu'] = 'newsList';
            $data['menuName'] = __('News List');
            $data['item'] = $news;
            $data['buttonTitle'] = __('Update');
            $data['title'] = __('Update News');

            return view('admin.news_feeds.addEdit', $data);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }

    public function newsAddProcess(NewsAddRequest $request)
    {
        try {
            $customer = Customer::where('user_id', Auth::id())->first();
            if ($request->id) {
                $updateData = [
                    'customer_id' => $customer->id,
                    'title' => $request->title,
                    'news' => $request->news,
                    'status' => $request->status
                ];
                if (!empty($request->image)) {
                    $image = uploadFile($request->image, newsImagePath());
                    $updateData['image']  = $image;
                }
                $this->service->update(['id' => $request->id], $updateData);

                return redirect()->back()->with(['success' => __('News has been updated successfully')]);
            } else {
                $image = null;
                if (!empty($request->image)) {
                    $image = uploadFile($request->image, newsImagePath());
                }
                $this->service->create([
                    'customer_id' => $customer->id,
                    'title' => $request->title,
                    'news' => $request->news,
                    'image' => $image,
                    'status' => $request->status
                ]);

                return redirect()->route('admin.newsList')->with(['success' => __('News has been added successfully')]);
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong') . $exception->getMessage()]);
        }
    }

    public function newsDelete($id)
    {
        try {
            $id = decrypt($id);
            $this->service->delete($id);

            return redirect()->back()->with(['success' => __('News has been deleted successfully')]);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => __('Something went wrong')]);
        }
    }
}
