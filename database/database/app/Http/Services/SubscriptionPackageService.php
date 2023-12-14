<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 4:18 PM
 */

namespace App\Http\Services;



use App\Http\Repository\SubscriptionPackageRepository;

class SubscriptionPackageService extends CommonService
{
    public $repository;

    function __construct()
    {
        $this->repository = new SubscriptionPackageRepository();
        parent::__construct($this->repository);
    }
}
