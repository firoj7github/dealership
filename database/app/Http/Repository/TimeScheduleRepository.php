<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/9/19
 * Time: 7:18 PM
 */

namespace App\Http\Repository;


use App\Models\TimeSchedule;

class TimeScheduleRepository extends CommonRepository
{
    public $model;

    function __construct()
    {
        $this->model = new TimeSchedule();
        parent::__construct($this->model);
    }
}
