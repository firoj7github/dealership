<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/23/19
 * Time: 12:08 PM
 */

namespace App\Http\Repository;


use App\Models\NewsFeed;

class NewsRepository extends CommonRepository
{
    public $model;

    function __construct()
    {
        $this->model = new NewsFeed();
        parent::__construct($this->model);
    }
}
