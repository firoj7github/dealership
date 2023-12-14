<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/8/19
 * Time: 5:53 PM
 */

namespace App\Http\Services;


use App\Http\Repository\ClinicRepository;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;

class ClinicService extends CommonService
{
    public $repository;

    function __construct()
    {
        $this->repository = new ClinicRepository();
        parent::__construct($this->repository);
    }

    public function locationList()
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
        $locations = $this->selectWhere(['id', 'name', 'address', 'zip_code', 'city', 'country', 'latitude', 'longitude'], ['customer_id' => $subscriber->customer->id, 'status' => ACTIVE_STATUS, 'type' => 1]);

        return [
            'success' => true,
            'message' => '',
            'data' => [
                'locations' => $locations
            ]
        ];
    }
}
