<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;


public function inventory()
{
    return $this->belongsTo(Inventory::class,'inventory_id');
}
public function banner()
{
    return $this->belongsTo(Banner::class,'banner_id');
}
public function slider()
{
    return $this->belongsTo(Slide::class,'slider_id');
}

public function Inventoryuser()
{
    return $this->belongsTo(Inventory::class,'user_id');
}


}
