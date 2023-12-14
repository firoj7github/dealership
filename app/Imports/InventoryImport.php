<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Car;
use App\Models\Inventory;


class InventoryImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    // public function collection(Collection $collection)
    // {
    //     $index = 0;

    //     foreach($collection as $item)
    //     {
    //         if($index >= 1 )
    //         {
    //             // Car::create([
    //             //     'vin'  =>  $item[2],
    //             //     'title' => $item[1],
    //             //     'year' => $item[1],
    //             //     'make' => $item[0],
    //             //     'model' => $item[0],
    //             //     'trim' => $item[0],
    //             //     'exterior_color' => $item[0],
    //             //     'interior_color' => $item[0],
    //             //     'mileage' => $item[9],
    //             //     'vehicle_condition' => $item[9],
    //             //     'price' => $item[3],
    //             //     'dealership_name' => $item[3],
    //             //     'dealership_address' => $item[3],
    //             //     'link' => $item[15],
    //             //     'image_link' => $item[15],
    //             //     'additional_image_link' => $item[15],
    //             //     'vehicle_options' => $item[15],
    //             //     'vehicle_fulfillment' => $item[15],
    //             //     'legal_disclaimer' => $item[15],
    //             //     'additional_image_link' => $item[15],
    //             //     'status' => $item[15],
    //             //     // 'engine' => $item[4],
    //             //     // 'latitude' => $item[5],
    //             //     // 'longitude'  =>  $item[6],
    //             //     // 'driventrain' => $item[7],
    //             //     // 'image' => $item[8],
    //             //     // 'body' => $item[10],
    //             //     // 'conditions' => $item[11],
    //             //     // 'category' => $item[12],
    //             //     // 'transmission' => $item[13],
    //             //     // 'fuel' => $item[14],
    //             //     // 'trending' => $item[13],
    //             // ]);

    //             Inventory::create([
    //                 'condition' => $item[0],
    //                 'stock' => $item[0],
    //                 'vin' => $item[0],
    //                 'year' => $item[0],
    //                 'make' => $item[0],
    //                 'model' => $item[0],
    //                 'trim' => $item[0],
    //                 'doors' => $item[0],
    //                 'interior_color' => $item[0],
    //                 'exterior_color' => $item[0],
    //                 'engine_cylinder' => $item[0],
    //                 'transmission' => $item[0],
    //                 'miles' => $item[0],
    //                 'Price' => $item[0],
    //                 'retails' => $item[0],
    //                 'date_in_stock' => $item[0],
    //                 'description' => $item[0],
    //                 'options' => $item[0],
    //                 'dealer_name' => $item[0],
    //                 'dealer_address' => $item[0],
    //                 'style' => $item[0],
    //                 'engine_aspiration_type' => $item[0],
    //                 'engine' => $item[0],
    //                 'transmission2' => $item[0],
    //                 'drivetrain' => $item[0],
    //                 'fuel' => $item[0],
    //                 'mpg_city' => $item[0],
    //                 'mpg_hwy' => $item[0],
    //                 'mpg_city' => $item[0],
    //                 'epa_classification' => $item[0],
    //                 'market_class' => $item[0],
    //                 'mpg_city' => $item[0],
    //                 'mpg_city' => $item[0],
    //                 'mpg_city' => $item[0],
    //                 'passenger_capacity' => $item[0],
    //                 'picture_from_url' => $item[0],
    //                 'passenger_capacity' => $item[0],
    //                 'title' => $item[0],
    //                 'owner_id' => $item[0],
    //                 'latitude' => $item[0],
    //                 'longitude' => $item[0],
    //                 'body' => $item[0],
    //                 'category' => $item[0],
    //                 'subcategory' => $item[0],
    //             ]);
    //         }
    //         $index++;
    //     }
    // }

    public function collection(Collection  $rows)
    {
        
        $index = 0;
        
        foreach($rows as $row){
            dd( $row);
            
            if($index >= 1 ){
                Inventory::create([
                    'condition'                 => $row['condition'],
                    'stock'                     => $row['stock'],
                    'vin'                       => $row['vin'],
                    'year'                      => $row['year'],
                    'make'                      => $row['make'],
                    'model'                     => $row['model'],
                    'trim'                      => $row['trim'],
                    'doors'                     => $row['doors'],
                    'exterior_color'            => $row['exterior_color'],
                    'interior_color'            => $row['interior_color'],
                    'engine_cylinder'           => $row['engine_cylinder'],
                    'transmission'              => $row['na_transmission'],
                    'miles'                     => $row['miles'],
                    'price'                     => $row['price'],
                    'retails'                   => $row['retails'],
                    'date_in_stock'             => $row['na_dateinstock'],
                    'description'               => $row['description'],
                    'options'                   => $row['na_options'],
                    'dealer_name'               => $row['na_dealer_name'],
                    'dealer_address'            => $row['na_dealer_address'],
                    'style_description'         => $row['na_style_description'],
                    'engine_aspiration_type'    => $row['na_engine_aspiration_type'],
                    'engine'                    => $row['engine'],
                    'transmission2'             => $row['transmission'],
                    'drive_train'               => $row['drive_train'],
                    'fuel'                      => $row['fuel'],
                    'mpg_city'                  => $row['mpg_city'],
                    'mpg_hwy'                   => $row['mpg_hwy'],
                    'marketclass'               => $row['na_marketclass'],
                    'passenger_capacity'        => $row['na_passenger_capacity'],
                    'picture_from_url'          => $row['picture_from_url'],
                ]);

            }
        $index++;

        }

    }
}