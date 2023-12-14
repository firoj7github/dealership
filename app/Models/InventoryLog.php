<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    use HasFactory;

    public function getPriceFormateAttribute()
    {
        $price = number_format($this->price, 0, '.', ',' );
        return $price;
    }

    public function getDateFormAttribute($value)
    {
        // Convert the VARCHAR date to the desired format
        $date = Carbon::createFromFormat('m/d/Y', $value);

        // Format the date as 'm/d/Y' and return it
        return $date->format('m/d/Y');
    }

}
