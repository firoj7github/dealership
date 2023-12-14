<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/8/19
 * Time: 7:38 PM
 */

namespace App\Http\Services;


use App\Http\Repository\TaskRepository;

class TaskService extends CommonService
{
    public $repository;

    function __construct()
    {
        $this->repository = new TaskRepository();
        parent::__construct($this->repository);
    }
}
