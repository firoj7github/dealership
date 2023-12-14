<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/9/19
 * Time: 7:18 PM
 */

namespace App\Http\Services;


use App\Http\Repository\TimeScheduleRepository;

class TimeScheduleService extends CommonService
{
    public $repository;

    function __construct()
    {
        $this->repository = new TimeScheduleRepository();
        parent::__construct($this->repository);
    }

    public function availabilityList($locationId)
    {
        $times = $this->getWhere(['clinic_id' => $locationId]);
        $times = $times->each(function ($item) {
            $item->day_name = weekDaysWithLanguage($item->day);
        });

        return [
            'success' => true,
            'message' => '',
            'data' => [
                'availabilities' => $times
            ]
        ];
    }
}
