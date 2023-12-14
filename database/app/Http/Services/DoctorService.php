<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/8/19
 * Time: 5:53 PM
 */

namespace App\Http\Services;


use App\Http\Repository\DoctorRepository;

class DoctorService extends CommonService
{
    public $repository;

    function __construct()
    {
        $this->repository = new DoctorRepository();
        parent::__construct($this->repository);
    }
}
