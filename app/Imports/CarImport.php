<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Car;

class CarImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $index = 0;

        foreach($collection as $item)
        {
            if($index >= 1 )
            {
                Car::create([
                    'model' => $item[0],
                    'title' => $item[1],
                    'vin'  =>  $item[2],
                    'price' => $item[3],
                    'engine' => $item[4],
                    'latitude' => $item[5],
                    'longitude'  =>  $item[6],
                    'driventrain' => $item[7],
                    'image' => $item[8],
                    'mileage' => $item[9],
                    'body' => $item[10],
                    'conditions' => $item[11],
                    'category' => $item[12],
                    'transmission' => $item[13],
                    'fuel' => $item[14],
                    'trending' => $item[13],
                    'status' => $item[15],
                ]);
            }
            $index++;
        }
    }
}