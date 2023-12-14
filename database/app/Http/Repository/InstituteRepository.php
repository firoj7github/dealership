<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/23/19
 * Time: 12:08 PM
 */

namespace App\Http\Repository;


use App\Models\Institute;

class InstituteRepository extends CommonRepository
{
    public $model;

    function __construct()
    {
        $this->model = new Institute();
        parent::__construct($this->model);
    }
}
