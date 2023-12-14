<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/8/19
 * Time: 5:55 PM
 */

namespace App\Http\Repository;


use App\Models\Appointment;

class AppointmentRepository extends CommonRepository
{
    public $model;

    function __construct()
    {
        $this->model = new Appointment();
        parent::__construct($this->model);
    }
}
