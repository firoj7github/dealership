<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMediaInfo extends Model
{
    use HasFactory;
    protected $table = 'inventory_media_info';
    protected $fillable = ['id','inventory_id'];

}
