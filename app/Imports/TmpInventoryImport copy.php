<?php

namespace App\Imports;

use App\Models\ArchivedTmpInventories;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


use App\Models\Car;
use App\Models\Inventory;
use App\Models\Tmp_inventory;



// class TmpInventoryImport implements ToCollection
// {
//     protected $insertedCount = 0;
//     protected $notInsertedCount = 0;
//     protected $archivedCount = 0;


//     public function collection(Collection $rows)
//     {


//         // Extract VIN values from the CSV data
//         $csvVinValues = $rows->skip(1)->pluck(3)->toArray();

//         // Get all VIN values from the database
//         $databaseVinValues = Tmp_inventory::pluck('vin')->toArray();

//         // Find VIN values that are in the database but not in the CSV
//         $vinValuesToUpdateAndDelete = array_diff($databaseVinValues, $csvVinValues);

//         // Update and archive records with VIN values not in the CSV
//         Tmp_inventory::whereIn('vin', $vinValuesToUpdateAndDelete)->each(function ($recordToUpdateAndDelete) {
//             $this->updateTmpInventoryStatus($recordToUpdateAndDelete);
//             $this->archiveRecord($recordToUpdateAndDelete);
//             $recordToUpdateAndDelete->delete();
//             $this->archivedCount++;
//         });

//         // Process the CSV data
//         foreach ($rows->skip(1) as $row) {
//             $vin = $row[3];
//             $inventoryData = Tmp_inventory::where('vin', $vin)->first();

//             if (!$inventoryData) {
//                 $this->insertedCount++;
//                 $this->createTmpInventory($row);
//             } else {
//                 $this->notInsertedCount++;
//             }
//         }
//     }

//     public function getInsertedCount()
//     {
//         return $this->insertedCount;
//     }

//     public function getNotInsertedCount()
//     {
//         return $this->notInsertedCount;
//     }

//     public function getArchivedCount()
//     {
//         return $this->archivedCount;
//     }

//     private function createTmpInventory($row)
//     {
//                  $formattedDate = date('Y-m-d', strtotime($row[22]));
                 
//                  $payment_price = $row[17];
//                  $interest_rate = 10 / 100;

//                  $calculateMonthValue = 72;

//                 $discount = $payment_price * $interest_rate; // Calculate interest discount
//                 $loan_amount = $payment_price - $discount; // Calculate the loan amount

//                 $monthly_interest_rate = $interest_rate / 12; // Calculate monthly interest rate

//                 // Calculate the monthly payment
//                 $monthly_payment = round(
//                     $loan_amount * ($monthly_interest_rate * pow(1 + $monthly_interest_rate, $calculateMonthValue))
//                     / (pow(1 + $monthly_interest_rate, $calculateMonthValue) - 1)
//                 );


//                 switch ($row[7]) {
//                     case '2dr Car':
//                         $car_body = 'Coupe';
//                         break;
//                     case '3dr Car':
//                         $car_body = 'Hatchback';
//                         break;
//                     case '4dr Car':
//                         $car_body = 'Sedan';
//                         break;
//                     case 'Crew Cab Pickup':
//                         $car_body = 'Truck';
//                         break;
//                     case 'Extended Cab Pickup':
//                         $car_body = 'Truck';
//                         break;
//                     case 'Regular Cab Pickup':
//                         $car_body = 'Truck';
//                         break;
//                     case 'Full-size Cargo Van':
//                         $car_body = 'Cargo Van';
//                         break;
//                     case 'Full-size Passenger Van':
//                         $car_body = 'Passenger Van';
//                         break;
//                     case 'Mini-van, Cargo':
//                         $car_body = 'Cargo Van';
//                         break;
//                     case 'Mini-van, Passenger':
//                         $car_body = 'Minivan';
//                         break;
//                     case 'Sport Utility':
//                         $car_body = 'SUV';
//                         break;
//                     default:
//                     $car_body = $row[7];
//                         break;
//                     }
//                             // $this->insertedCount++;
            
//                             Tmp_inventory::create([     
//                                 'dealer_id'                         => $row[0],
//                                 'condition'                         => $row[1],
//                                 'stock'                             => $row[2],
//                                 'vin'                               => $row[3],
//                                 'year'                              => $row[4],
//                                 'make'                              => $row[5],
//                                 'model'                             => $row[6],
//                                 'body'                              => $row[7],
//                                 'trim'                              => $row[8],
//                                 'model_number'                      => $row[9],
//                                 'doors'                             => $row[10],
//                                 'exterior_color'                    => $row[11],
//                                 'interior_color'                    => $row[12],
//                                 'engine_cylinder'                   => $row[13],
//                                 'engine_displacement'               => $row[14],
//                                 'transmission'                      => $row[15],
//                                 'miles'                             => $row[16],
//                                 'price'                             => $row[17],
//                                 'retails'                           => $row[18],
//                                 'book_value'                        => $row[19],
//                                 'invoice'                           => $row[20],
//                                 'certified      '                   => $row[21],
//                                 'date_in_stock'                     => $row[22],
//                                 'description'                       => $row[23],
//                                 'options'                           => $row[24],
//                                 'categorized_options'               => $row[25],
//                                 'dealer_name'                       => $row[26],
//                                 'dealer_address'                    => $row[27],
//                                 'dealer_city'                       => $row[28],
//                                 'dealer_state'                      => $row[29],
//                                 'dealer_zip'                        => $row[30],
//                                 'dealer_phone'                      => $row[31],
//                                 'dealer_fax'                        => $row[32],
//                                 'dealer_email'                      => $row[33],
//                                 'comment_1'                         => $row[34],
//                                 'comment_2'                         => $row[35],
//                                 'comment_3'                         => $row[36],
//                                 'comment_4'                         => $row[37],
//                                 'comment_5'                         => $row[38],
//                                 'style_description'                 => $row[39],
//                                 'ext_color_generic'                 => $row[40],
//                                 'ext_color_code'                    => $row[41],
//                                 'int_color_generic'                 => $row[42],
//                                 'int_color_code'                    => $row[43],
//                                 'int_upholstery'                    => $row[44],
//                                 'engine_block_type'                 => $row[45],
//                                 'engine_aspiration_type'            => $row[46],
//                                 'engine_description'                => $row[47],
//                                 'transmission_speed'                => $row[48],               
//                                 'transmission_description'          => $row[49],               
//                                 'drive_train'                       => $row[50],
//                                 'fuel'                              => $row[51],
//                                 'mpg_city'                          => $row[52],
//                                 'mpg_hwy'                           => $row[53],
//                                 'epa_classification'                => $row[54],
//                                 'wheelbase_code'                    => $row[55],
//                                 'internet_price'                    => $row[56],
//                                 'misc_price_1'                      => $row[57],
//                                 'misc_price_2'                      => $row[58],
//                                 'misc_price_3'                      => $row[59],
//                                 'factory_codes'                     => $row[60],
//                                 'market_class'                      => $row[61],
//                                 'passenger_capacity'                => $row[62],
//                                 'ext_color_hex_Code'                => $row[63],
//                                 'int_color_hex_Code'                => $row[64],
//                                 'engine_displacement_cubicInches'   => $row[65],
//                                 'image_from_url'                    => $row[66],
//                                 'stock_date_formated'               => $formattedDate,
//                                 'payment_price'                     => $monthly_payment,
//                                 'body_formated'                     => $car_body,
//                                 'status'                            => 1,
//                             ]);
//     }

//     private function updateTmpInventoryStatus($inventoryData)
//     {
//         if ($inventoryData) {
//             $inventoryData->update([
//                 'status' => 0,
//             ]);
//         }
//     }

//     private function archiveRecord($recordToArchive)
//     {
//         if ($recordToArchive) {
//         ArchivedTmpInventories::create([
//             'tmp_inventory_id'                  => $recordToArchive->id,
//             'dealer_id'                         => $recordToArchive->dealer_id,
//             'condition'                         => $recordToArchive->condition,
//             'stock'                             => $recordToArchive->stock,
//             'vin'                               => $recordToArchive->vin,
//             'year'                              => $recordToArchive->year,
//             'make'                              => $recordToArchive->make,
//             'model'                             => $recordToArchive->model,
//             'body'                              => $recordToArchive->body,
//             'trim'                              => $recordToArchive->trim,
//             'model_number'                      => $recordToArchive->model_number,
//             'doors'                             => $recordToArchive->doors,
//             'exterior_color'                    => $recordToArchive->exterior_color,
//             'interior_color'                    => $recordToArchive->interior_color,
//             'engine_cylinder'                   => $recordToArchive->engine_cylinder,
//             'engine_displacement'               => $recordToArchive->engine_displacement,
//             'transmission'                      => $recordToArchive->transmission,
//             'miles'                             => $recordToArchive->miles,
//             'price'                             => $recordToArchive->price,
//             'retails'                           => $recordToArchive->retails,
//             'book_value'                        => $recordToArchive->book_value,
//             'invoice'                           => $recordToArchive->invoice,
//             'certified      '                   => $recordToArchive->certified,
//             'date_in_stock'                     => $recordToArchive->date_in_stock,
//             'description'                       => $recordToArchive->description,
//             'options'                           => $recordToArchive->options,
//             'categorized_options'               => $recordToArchive->categorized_options,
//             'dealer_name'                       => $recordToArchive->dealer_name,
//             'dealer_address'                    => $recordToArchive->dealer_address,
//             'dealer_city'                       => $recordToArchive->dealer_city,
//             'dealer_state'                      => $recordToArchive->dealer_state,
//             'dealer_zip'                        => $recordToArchive->dealer_zip,
//             'dealer_phone'                      => $recordToArchive->dealer_phone,
//             'dealer_fax'                        => $recordToArchive->dealer_fax,
//             'dealer_email'                      => $recordToArchive->dealer_email,
//             'comment_1'                         => $recordToArchive->comment_1,
//             'comment_2'                         => $recordToArchive->comment_2,
//             'comment_3'                         => $recordToArchive->comment_3,
//             'comment_4'                         => $recordToArchive->comment_4,
//             'comment_5'                         => $recordToArchive->comment_5,
//             'style_description'                 => $recordToArchive->style_description,
//             'ext_color_generic'                 => $recordToArchive->ext_color_generic,
//             'ext_color_code'                    => $recordToArchive->ext_color_code,
//             'int_color_generic'                 => $recordToArchive->int_color_generic,
//             'int_color_code'                    => $recordToArchive->int_color_code,
//             'int_upholstery'                    => $recordToArchive->int_upholstery,
//             'engine_block_type'                 => $recordToArchive->engine_block_type,
//             'engine_aspiration_type'            => $recordToArchive->engine_aspiration_type,
//             'engine_description'                => $recordToArchive->engine_description,
//             'transmission_speed'                => $recordToArchive->transmission_speed,               
//             'transmission_description'          => $recordToArchive->transmission_description,               
//             'drive_train'                       => $recordToArchive->drive_train,
//             'fuel'                              => $recordToArchive->fuel,
//             'mpg_city'                          => $recordToArchive->mpg_city,
//             'mpg_hwy'                           => $recordToArchive->mpg_hwy,
//             'epa_classification'                => $recordToArchive->epa_classification,
//             'wheelbase_code'                    => $recordToArchive->wheelbase_code,
//             'internet_price'                    => $recordToArchive->internet_price,
//             'misc_price_1'                      => $recordToArchive->misc_price_1,
//             'misc_price_2'                      => $recordToArchive->misc_price_2,
//             'misc_price_3'                      => $recordToArchive->misc_price_3,
//             'factory_codes'                     => $recordToArchive->factory_codes,
//             'market_class'                      => $recordToArchive->market_class,
//             'passenger_capacity'                => $recordToArchive->passenger_capacity,
//             'ext_color_hex_Code'                => $recordToArchive->ext_color_hex_Code,
//             'int_color_hex_Code'                => $recordToArchive->int_color_hex_Code,
//             'engine_displacement_cubicInches'   => $recordToArchive->engine_displacement_cubicInches,
//             'image_from_url'                    => $recordToArchive->image_from_url,
//             'stock_date_formated'               => $recordToArchive->stock_date_formated,
//             'payment_price'                     => $recordToArchive->payment_price,
//             'body_formated'                     => $recordToArchive->body_formated,
//             'status'                            => $recordToArchive->status,
//         ]);




//             $recordToArchive->delete();
//         }
//     }
// }


class TmpInventoryImport implements ToCollection
{
    protected $insertedCount = 0;
    protected $notInsertedCount = 0;
    protected $archivedCount = 0;
    protected $updatedCount = 0;


    public function collection(Collection $rows)
    {
        // Extract VIN values from the CSV data
        $csvVinValues = $rows->skip(1)->pluck(3)->toArray();
        
        // Get all VIN values from the database
        $databaseVinValues = Tmp_inventory::pluck('vin')->toArray();
        
        // Find VIN values that are in the database but not in the CSV
        $vinValuesToUpdateAndDelete = array_diff($databaseVinValues, $csvVinValues);
        
        
        // Update and archive records with VIN values not in the CSV
        Tmp_inventory::whereIn('vin', $vinValuesToUpdateAndDelete)->each(function ($recordToUpdateAndDelete) {
            $this->updateTmpInventoryStatus($recordToUpdateAndDelete);
            $this->archiveRecord($recordToUpdateAndDelete);
            $recordToUpdateAndDelete->delete();
            $this->archivedCount++;
        });


                // Process the CSV data
                foreach ($rows->skip(1) as $row) {
                    $vin = $row[3];
                    $inventoryData = Tmp_inventory::where('vin', $vin)->first();
        
                    if (!$inventoryData) {
                        $this->insertedCount++;
                        $this->createTmpInventory($row);
                    } else {
                        // Check for changes and update if necessary
                        if ($this->hasDataChanged($inventoryData, $row)) {
                            $this->updateTmpInventory($inventoryData, $row);
                            $this->updatedCount++;
                        } else {
                            $this->notInsertedCount++;
                        }
                    }
                }

                dd($this->hasDataChanged($inventoryData, $row));

        // // Process the CSV data
        // foreach ($rows->skip(1) as $row) {
        //     $vin = $row[3];
        //     $inventoryData = Tmp_inventory::where('vin', $vin)->first();

        //     if (!$inventoryData) {
        //         $this->insertedCount++;
        //         $this->createTmpInventory($row);
        //     } else {
        //         $this->notInsertedCount++;
        //     }
        // }
    }

    public function getInsertedCount()
    {
        return $this->insertedCount;
    }

    public function getNotInsertedCount()
    {
        return $this->notInsertedCount;
    }

    public function getArchivedCount()
    {
        return $this->archivedCount;
    }

    private function createTmpInventory($row)
    {
                 $formattedDate = date('Y-m-d', strtotime($row[22]));
                 
                 $payment_price = $row[17];
                 $interest_rate = 10 / 100;

                 $calculateMonthValue = 72;

                $discount = $payment_price * $interest_rate; // Calculate interest discount
                $loan_amount = $payment_price - $discount; // Calculate the loan amount

                $monthly_interest_rate = $interest_rate / 12; // Calculate monthly interest rate

                // Calculate the monthly payment
                $monthly_payment = ceil(
                    $loan_amount * ($monthly_interest_rate * pow(1 + $monthly_interest_rate, $calculateMonthValue))
                    / (pow(1 + $monthly_interest_rate, $calculateMonthValue) - 1)
                );


                switch ($row[7]) {
                    case '2dr Car':
                        $car_body = 'Coupe';
                        break;
                    case '3dr Car':
                        $car_body = 'Hatchback';
                        break;
                    case '4dr Car':
                        $car_body = 'Sedan';
                        break;
                    case 'Crew Cab Pickup':
                        $car_body = 'Truck';
                        break;
                    case 'Extended Cab Pickup':
                        $car_body = 'Truck';
                        break;
                    case 'Regular Cab Pickup':
                        $car_body = 'Truck';
                        break;
                    case 'Full-size Cargo Van':
                        $car_body = 'Cargo Van';
                        break;
                    case 'Full-size Passenger Van':
                        $car_body = 'Passenger Van';
                        break;
                    case 'Mini-van, Cargo':
                        $car_body = 'Cargo Van';
                        break;
                    case 'Mini-van, Passenger':
                        $car_body = 'Minivan';
                        break;
                    case 'Sport Utility':
                        $car_body = 'SUV';
                        break;
                    default:
                    $car_body = $row[7];
                        break;
                    }
                            // $this->insertedCount++;
            
                            Tmp_inventory::create([     
                                'dealer_id'                         => $row[0],
                                'condition'                         => $row[1],
                                'stock'                             => $row[2],
                                'vin'                               => $row[3],
                                'year'                              => $row[4],
                                'make'                              => $row[5],
                                'model'                             => $row[6],
                                'body'                              => $row[7],
                                'trim'                              => $row[8],
                                'model_number'                      => $row[9],
                                'doors'                             => $row[10],
                                'exterior_color'                    => $row[11],
                                'interior_color'                    => $row[12],
                                'engine_cylinder'                   => $row[13],
                                'engine_displacement'               => $row[14],
                                'transmission'                      => $row[15],
                                'miles'                             => $row[16],
                                'price'                             => $row[17],
                                'retails'                           => $row[18],
                                'book_value'                        => $row[19],
                                'invoice'                           => $row[20],
                                'certified      '                   => $row[21],
                                'date_in_stock'                     => $row[22],
                                'description'                       => $row[23],
                                'options'                           => $row[24],
                                'categorized_options'               => $row[25],
                                'dealer_name'                       => $row[26],
                                'dealer_address'                    => $row[27],
                                'dealer_city'                       => $row[28],
                                'dealer_state'                      => $row[29],
                                'dealer_zip'                        => $row[30],
                                'dealer_phone'                      => $row[31],
                                'dealer_fax'                        => $row[32],
                                'dealer_email'                      => $row[33],
                                'comment_1'                         => $row[34],
                                'comment_2'                         => $row[35],
                                'comment_3'                         => $row[36],
                                'comment_4'                         => $row[37],
                                'comment_5'                         => $row[38],
                                'style_description'                 => $row[39],
                                'ext_color_generic'                 => $row[40],
                                'ext_color_code'                    => $row[41],
                                'int_color_generic'                 => $row[42],
                                'int_color_code'                    => $row[43],
                                'int_upholstery'                    => $row[44],
                                'engine_block_type'                 => $row[45],
                                'engine_aspiration_type'            => $row[46],
                                'engine_description'                => $row[47],
                                'transmission_speed'                => $row[48],               
                                'transmission_description'          => $row[49],               
                                'drive_train'                       => $row[50],
                                'fuel'                              => $row[51],
                                'mpg_city'                          => $row[52],
                                'mpg_hwy'                           => $row[53],
                                'epa_classification'                => $row[54],
                                'wheelbase_code'                    => $row[55],
                                'internet_price'                    => $row[56],
                                'misc_price_1'                      => $row[57],
                                'misc_price_2'                      => $row[58],
                                'misc_price_3'                      => $row[59],
                                'factory_codes'                     => $row[60],
                                'market_class'                      => $row[61],
                                'passenger_capacity'                => $row[62],
                                'ext_color_hex_Code'                => $row[63],
                                'int_color_hex_Code'                => $row[64],
                                'engine_displacement_cubicInches'   => $row[65],
                                'image_from_url'                    => $row[66],
                                'stock_date_formated'               => $formattedDate,
                                'payment_price'                     => $monthly_payment,
                                'body_formated'                     => $car_body,
                                'status'                            => 1,
                            ]);
    }

    private function updateTmpInventoryStatus($inventoryData)
    {
        if ($inventoryData) {
            $inventoryData->update([
                'status' => 0,
            ]);
        }
    }

    private function archiveRecord($recordToArchive)
    {
        if ($recordToArchive) {
        ArchivedTmpInventories::create([
            'tmp_inventory_id'                  => $recordToArchive->id,
            'dealer_id'                         => $recordToArchive->dealer_id,
            'condition'                         => $recordToArchive->condition,
            'stock'                             => $recordToArchive->stock,
            'vin'                               => $recordToArchive->vin,
            'year'                              => $recordToArchive->year,
            'make'                              => $recordToArchive->make,
            'model'                             => $recordToArchive->model,
            'body'                              => $recordToArchive->body,
            'trim'                              => $recordToArchive->trim,
            'model_number'                      => $recordToArchive->model_number,
            'doors'                             => $recordToArchive->doors,
            'exterior_color'                    => $recordToArchive->exterior_color,
            'interior_color'                    => $recordToArchive->interior_color,
            'engine_cylinder'                   => $recordToArchive->engine_cylinder,
            'engine_displacement'               => $recordToArchive->engine_displacement,
            'transmission'                      => $recordToArchive->transmission,
            'miles'                             => $recordToArchive->miles,
            'price'                             => $recordToArchive->price,
            'retails'                           => $recordToArchive->retails,
            'book_value'                        => $recordToArchive->book_value,
            'invoice'                           => $recordToArchive->invoice,
            'certified      '                   => $recordToArchive->certified,
            'date_in_stock'                     => $recordToArchive->date_in_stock,
            'description'                       => $recordToArchive->description,
            'options'                           => $recordToArchive->options,
            'categorized_options'               => $recordToArchive->categorized_options,
            'dealer_name'                       => $recordToArchive->dealer_name,
            'dealer_address'                    => $recordToArchive->dealer_address,
            'dealer_city'                       => $recordToArchive->dealer_city,
            'dealer_state'                      => $recordToArchive->dealer_state,
            'dealer_zip'                        => $recordToArchive->dealer_zip,
            'dealer_phone'                      => $recordToArchive->dealer_phone,
            'dealer_fax'                        => $recordToArchive->dealer_fax,
            'dealer_email'                      => $recordToArchive->dealer_email,
            'comment_1'                         => $recordToArchive->comment_1,
            'comment_2'                         => $recordToArchive->comment_2,
            'comment_3'                         => $recordToArchive->comment_3,
            'comment_4'                         => $recordToArchive->comment_4,
            'comment_5'                         => $recordToArchive->comment_5,
            'style_description'                 => $recordToArchive->style_description,
            'ext_color_generic'                 => $recordToArchive->ext_color_generic,
            'ext_color_code'                    => $recordToArchive->ext_color_code,
            'int_color_generic'                 => $recordToArchive->int_color_generic,
            'int_color_code'                    => $recordToArchive->int_color_code,
            'int_upholstery'                    => $recordToArchive->int_upholstery,
            'engine_block_type'                 => $recordToArchive->engine_block_type,
            'engine_aspiration_type'            => $recordToArchive->engine_aspiration_type,
            'engine_description'                => $recordToArchive->engine_description,
            'transmission_speed'                => $recordToArchive->transmission_speed,               
            'transmission_description'          => $recordToArchive->transmission_description,               
            'drive_train'                       => $recordToArchive->drive_train,
            'fuel'                              => $recordToArchive->fuel,
            'mpg_city'                          => $recordToArchive->mpg_city,
            'mpg_hwy'                           => $recordToArchive->mpg_hwy,
            'epa_classification'                => $recordToArchive->epa_classification,
            'wheelbase_code'                    => $recordToArchive->wheelbase_code,
            'internet_price'                    => $recordToArchive->internet_price,
            'misc_price_1'                      => $recordToArchive->misc_price_1,
            'misc_price_2'                      => $recordToArchive->misc_price_2,
            'misc_price_3'                      => $recordToArchive->misc_price_3,
            'factory_codes'                     => $recordToArchive->factory_codes,
            'market_class'                      => $recordToArchive->market_class,
            'passenger_capacity'                => $recordToArchive->passenger_capacity,
            'ext_color_hex_Code'                => $recordToArchive->ext_color_hex_Code,
            'int_color_hex_Code'                => $recordToArchive->int_color_hex_Code,
            'engine_displacement_cubicInches'   => $recordToArchive->engine_displacement_cubicInches,
            'image_from_url'                    => $recordToArchive->image_from_url,
            'stock_date_formated'               => $recordToArchive->stock_date_formated,
            'payment_price'                     => $recordToArchive->payment_price,
            'body_formated'                     => $recordToArchive->body_formated,
            'status'                            => $recordToArchive->status,
        ]);




            $recordToArchive->delete();
        }
    }

    private function hasDataChanged($inventoryData, $csvRow)
    {

        dd($inventoryData->dealer_id !=  $csvRow[0]);

    if ($inventoryData->dealer_id != $csvRow[0] ||
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->stock     != $csvRow[1] || 

        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] || 
        $inventoryData->condition != $csvRow[1] 
        )
    
     {
        // If changes are detected, update the record
        $this->updateTmpInventory($inventoryData, $csvRow);

        return true; // Data has changed
    }

    return false; // No changes detected
    }

    private function updateTmpInventory($inventoryData, $csvRow)
    {
        // Update the fields in $inventoryData with data from $csvRow
        // Example:
        $inventoryData->update([
            'field1' => $csvRow[0],
            'field2' => $csvRow[1],
            // ... (update other fields)
        ]);
    }
}


// "dealer_id" => 19701
// "condition" => "Used"
// "stock" => "605355"

// "vin" => "5N1DR2BN0LC605355"

// "year" => "2020"
// "make" => "Nissan"
// "model" => "Pathfinder"
// "body" => "Sport Utility"
// "trim" => "SV"
// "model_number" => "25310"
// "doors" => 4
// "exterior_color" => "Gun Metallic"
// "interior_color" => "Charcoal"
// "engine_cylinder" => 6
// "engine_displacement" => "3.5 L"
// "transmission" => "Variable"
// "miles" => 40837
// "price" => 26500.0
// "retails" => 27950.0
// "book_value" => 0.0
// "invoice" => 27786
// "certified" => null
// "date_in_stock" => "5/31/2022"
// "description" => "Boasts 27 Highway MPG and 20 City MPG! This Nissan Pathfinder delivers a Regular Unleaded V-6 3.5 L/213 engine powering this Variable transmission. GUN METALLIC ▶"
// "options" => "GUN METALLIC,[L92] CARPETED FLOOR MATS (4-PC SET)  -inc: 1st  2nd and 3rd rows,CHARCOAL  CLOTH SEATING SURFACES,Front Wheel Drive,Power Steering,ABS,4-Wheel Dis ▶"
// "categorized_options" => "Exterior@Black Bodyside Cladding~Exterior@Black Grille w/Chrome Surround~Exterior@Black Side Windows Trim, Black Front Windshield Trim and Black Rear Window Tri ▶"
// "dealer_name" => "SKCO Automotive"
// "dealer_address" => "7410 Airport Blvd"
// "dealer_city" => "Mobile"
// "dealer_state" => "AL"
// "dealer_zip" => "36608"
// "dealer_phone" => "(251) 343-4488"
// "dealer_fax" => null
// "dealer_email" => null
// "comment_1" => null
// "comment_2" => "0"
// "comment_3" => null
// "comment_4" => null
// "comment_5" => null
// "style_description" => "FWD SV"
// "ext_color_generic" => "Gray"
// "ext_color_code" => "KAD"
// "int_color_generic" => "Gray"
// "int_color_code" => "G"
// "int_upholstery" => null
// "engine_block_type" => "V"
// "engine_aspiration_type" => "Gasoline Direct Injection"
// "engine_description" => "Regular Unleaded V-6 3.5 L/213"
// "transmission_speed" => 1
// "transmission_description" => "1-Speed CVT w/OD"
// "drive_train" => "FWD"
// "fuel" => "Gasoline Fuel"
// "mpg_city" => 20
// "mpg_hwy" => 27
// "epa_classification" => "Small SUV 2WD"
// "wheelbase_code" => 114.2
// "internet_price" => 0.0
// "misc_price_1" => 0.0
// "misc_price_2" => 0.0
// "misc_price_3" => 0.0
// "factory_codes" => "KAD FL2 G-0"
// "market_class" => "2WD Sport Utility Vehicles"
// "passenger_capacity" => "7"
// "ext_color_hex_Code" => "373837"
// "int_color_hex_Code" => null
// "engine_displacement_cubicInches" => "213"
// "image_from_url" => "https://content.homenetiol.com/2003297/2226628/0x0/4cb8010acd804fb982211f91af2d2b5c.jpg,https://content.homenetiol.com/2003297/2226628/0x0/2b710135035f4d1ea6b39 ▶"
// "stock_date_formated" => "2022-05-31"
// "payment_price" => 394.0
// "body_formated" => "SUV"
// "status" => 1
// "created_at" => "2023-09-25 10:17:30"
// "updated_at" => "2023-09-25 10:17:30"
// "deleted_at" => null





// 0 => 19701
// 1 => "Used"
// 2 => 605355
// 3 => "5N1DR2BN0LC605355"
// 4 => 2020
// 5 => "Nissan"
// 6 => "Pathfinder"
// 7 => "Sport Utility"
// 8 => "SV"
// 9 => 25310
// 10 => 4
// 11 => "Gun Metallic"
// 12 => "Charcoal"
// 13 => 6
// 14 => "3.5 L"
// 15 => "Variable"
// 16 => 40837
// 17 => 26500
// 18 => 27950
// 19 => 0
// 20 => 27786
// 21 => false
// 22 => "5/31/2022"
// 23 => "Boasts 27 Highway MPG and 20 City MPG! This Nissan Pathfinder delivers a Regular Unleaded V-6 3.5 L/213 engine powering this Variable transmission. GUN METALLIC ▶"
// 24 => "GUN METALLIC,[L92] CARPETED FLOOR MATS (4-PC SET)  -inc: 1st  2nd and 3rd rows,CHARCOAL  CLOTH SEATING SURFACES,Front Wheel Drive,Power Steering,ABS,4-Wheel Dis ▶"
// 25 => "Exterior@Black Bodyside Cladding~Exterior@Black Grille w/Chrome Surround~Exterior@Black Side Windows Trim, Black Front Windshield Trim and Black Rear Window Tri ▶"
// 26 => "SKCO Automotive"
// 27 => "7410 Airport Blvd"
// 28 => "Mobile"
// 29 => "AL"
// 30 => 36608
// 31 => "(251) 343-4488"
// 32 => null
// 33 => null
// 34 => null
// 35 => false
// 36 => null
// 37 => null
// 38 => null
// 39 => "FWD SV"
// 40 => "Gray"
// 41 => "KAD"
// 42 => "Gray"
// 43 => "G"
// 44 => null
// 45 => "V"
// 46 => "Gasoline Direct Injection"
// 47 => "Regular Unleaded V-6 3.5 L/213"
// 48 => 1
// 49 => "1-Speed CVT w/OD"
// 50 => "FWD"
// 51 => "Gasoline Fuel"
// 52 => 20
// 53 => 27
// 54 => "Small SUV 2WD"
// 55 => 114.2
// 56 => 0
// 57 => 0
// 58 => 0
// 59 => 0
// 60 => "KAD FL2 G-0"
// 61 => "2WD Sport Utility Vehicles"
// 62 => 7
// 63 => 373837
// 64 => null
// 65 => 213
// 66 => "https://content.homenetiol.com/2003297/2226628/0x0/4cb8010acd804fb982211f91af2d2b5c.jpg,https://content.homenetiol.com/2003297/2226628/0x0/2b710135035f4d1ea6b39 ▶"