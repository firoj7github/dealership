<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 4:17 PM
 */

namespace App\Http\Services;


class CommonService
{
    public $repository;

    function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function update($where, $data)
    {
        return $this->repository->update($where, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function getAll($relation = [])
    {
        return $this->repository->getAll($relation);
    }

    public function getWhere($where, $relation = [])
    {
        return $this->repository->getWhere($where, $relation);
    }

    public function selectWhere($select, $where, $relation = [], $paginate = 0)
    {
        return $this->repository->selectWhere($select, $where, $relation, $paginate);
    }
}