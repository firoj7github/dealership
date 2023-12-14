<?php

namespace App\Imports;

use App\Models\Institute;
use Maatwebsite\Excel\Concerns\ToModel;

class InstituteImport implements ToModel
{
    private $district;
    private $upozila;

    function __construct($district, $upozila)
    {
        $this->district = $district;
        $this->upozila = $upozila;
    }

    public function model(array $row)
    {
        return new Institute([
            'district' => $this->district,
            'upozila' => $this->upozila,
            'name' => $row[0],
            'status' => ACTIVE_STATUS
        ]);
    }
}
