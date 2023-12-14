<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    public function tmp_inventories_car()
    {
        return $this->belongsTo(Inventory::class,'tmp_inventories_id');
    }

    public function inventories_car()
    {
        return $this->belongsTo(Inventory::class,'inventory_id');
    }
    public function message()
    {
        return $this->belongsTo(LeadMessage::class,'inventory_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
