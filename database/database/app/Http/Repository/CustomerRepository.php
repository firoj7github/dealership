<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 7:31 PM
 */

namespace App\Http\Repository;


use App\Models\Customer;

class CustomerRepository extends CommonRepository
{
    public $model;

    function __construct()
    {
        $this->model = new Customer();
        parent::__construct($this->model);
    }
}