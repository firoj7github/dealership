<?php

namespace App\Interface;

interface BaseServiceInterface
{
    public function all();

    public function store(array $attributes);

    public function update(array $attributes, int $id);

    public function find(int $id);

    public function trash(int $id);

    public function bulkTrash(array $ids);

    public function getTrashedItem();

    public function getTrashedCount();

    public function permanentDelete(int $id);

    public function bulkPermanentDelete(array $ids);

    public function restore(int $id);

    public function bulkRestore(array $ids);

    public function getRowCount();
}
?>
