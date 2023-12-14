<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/8/19
 * Time: 5:55 PM
 */

namespace App\Http\Repository;


use App\Models\Calendar;

class DoctorRepository extends CommonRepository
{
    public $model;

    function __construct()
    {
        $this->model = new Calendar();
        parent::__construct($this->model);
    }
}