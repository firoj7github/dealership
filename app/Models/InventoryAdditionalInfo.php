<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAdditionalInfo extends Model
{
    use HasFactory;
    protected $table = 'inventory_additional_info';
    protected $guarded = ['id'];

}
