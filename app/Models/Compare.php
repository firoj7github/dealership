<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    use HasFactory;

    public function lists(){
       return $this->belongsTo(Inventory::class, 'inventory_id');
    }
}
