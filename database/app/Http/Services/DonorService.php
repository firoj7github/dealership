<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/23/19
 * Time: 12:08 PM
 */

namespace App\Http\Services;


use App\Http\Repository\DonorRepository;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;

class DonorService extends CommonService
{
    public $repository;

    function __construct()
    {
        $this->repository = new DonorRepository();
        parent::__construct($this->repository);
    }

    public function newsList()
    {
        $user = Auth::user();
        $subscriber = Subscriber::where(['id' => $user->subscriber_id, 'status' => ACTIVE_STATUS])->first();
        if (empty($subscriber)) {
            return [
                'success' => false,
                'message' => __('Invalid subscriber'),
                'data' => null
            ];
        }
        $news = $this->selectWhere(['id', 'title', 'news', 'image'], ['customer_id' => $subscriber->customer->id, 'status' => ACTIVE_STATUS]);
        $news = $news->each(function ($item) {
            $item->image = asset(newsImageViewPath() . $item->image);
        });

        return [
            'success' => true,
            'message' => '',
            'data' => [
                'news' => $news
            ]
        ];
    }
}
