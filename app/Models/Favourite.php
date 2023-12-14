<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Tmp_inventory;

class Favourite extends Model
{
    use HasFactory;
    protected $table = 'favourites';
    protected $guarded =['id'];

    public static function countWishList($inventory_id,$ip)
    {
        $countWishList = Favourite::where(['ip_address' => $ip, 'inventory_id' => $inventory_id])->count();
        return $countWishList;
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }


}
