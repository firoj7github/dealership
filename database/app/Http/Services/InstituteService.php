<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/23/19
 * Time: 12:08 PM
 */

namespace App\Http\Services;


use App\Http\Repository\InstituteRepository;

class InstituteService extends CommonService
{
    public $repository;

    function __construct()
    {
        $this->repository = new InstituteRepository();
        parent::__construct($this->repository);
    }
}
