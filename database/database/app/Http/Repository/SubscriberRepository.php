<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 4:25 PM
 */

namespace App\Http\Repository;


use App\Models\Subscriber;

class SubscriberRepository extends CommonRepository
{
    public $model;

    function __construct()
    {
        $this->model = new Subscriber();
        parent::__construct($this->model);
    }
}
