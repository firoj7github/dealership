<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/8/19
 * Time: 2:41 PM
 */

namespace App\Http\Repository;


use App\Models\Clinic;

class ClinicRepository extends CommonRepository
{
    public $model;

    function __construct()
    {
        $this->model = new Clinic();
        parent::__construct($this->model);
    }
}