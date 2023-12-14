<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerInfo extends Model
{
    use HasFactory;
    protected $table = 'dealer_infos';
    protected $guarded = ['id'];
    public function dealer_information()
    {
        return $this->belongsTo(Inventory::class,'user_id');
    }

}
