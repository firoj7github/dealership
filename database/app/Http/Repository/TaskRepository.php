<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/8/19
 * Time: 7:38 PM
 */

namespace App\Http\Repository;


use App\Models\Task;

class TaskRepository extends CommonRepository
{
    public $model;

    function __construct()
    {
        $this->model = new Task();
        parent::__construct($this->model);
    }
}
