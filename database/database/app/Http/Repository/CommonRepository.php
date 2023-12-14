<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 4:17 PM
 */

namespace App\Http\Repository;


class CommonRepository
{
    public $model;

    function __construct($model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($where, $data)
    {
        return $this->model->where($where)->update($data);
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->update(['status' => DELETE_STATUS]);
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getAll($relation = [])
    {
        return $this->model->with($relation)->get();
    }

    public function getWhere($where = [], $relation = [])
    {
        return $this->model->where($where)->with($relation)->get();
    }

    public function selectWhere($select, $where, $relation = [], $paginate = 0)
    {
        if ($paginate === 0) {
            return $this->model->select($select)->where($where)->with($relation)->get();
        }

        return $this->model->select($select)->where($where)->with($relation)->paginate($paginate);
    }
}