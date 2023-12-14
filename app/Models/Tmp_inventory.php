<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favourite;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tmp_inventory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tmp_inventories';
    protected $guarded = ['id'];

    public function getTitleAttribute()
    {
        // return $this->year.' '.$this->make.' '.$this->model.' '.$this->trim.' '.$this->body;
        return $this->year.' '.$this->make.' '.$this->model.' '.$this->trim;
    }

    public function getTitleWithBodyAttribute()
    {
        return $this->year.' '.$this->make.' '.$this->model.' '.$this->trim.' '.$this->body;
        // return $this->year.' '.$this->make.' '.$this->model.' '.$this->trim;
    }

    public function getImageAttribute()
    {
        $image = explode(',', $this->image_from_url);
        return $image[0];
    }

    public function getStockDateAttribute()
    {

        $stock_date = strtotime($this->date_in_stock);
        $date = date('F', $stock_date).' '.date('d', $stock_date).', '.date('Y', $stock_date);
        return $date;

    }

    public static function monthlyPrice($price)
    {
        $info = floor($price /12);
        return $info;
    }

    public function getPriceFormateAttribute()
    {
        $price = $this->price != 0 ? '$' . number_format($this->price, 0, '.', ',') : 'Email for price';
        return $price;
    }

    public function getMilesFormateAttribute()
    {
        $price = number_format($this->miles, 0, '.', ',' );
        return $price;
    }

    public function getdealerAddressFormateAttribute()
    {
        $dealer_address = $this->dealer_city.', '.$this->dealer_state.'.';
        return $dealer_address;
    }

    public function getEngineDescriptionFormateAttribute()
    {
        // $data = $this->engine_block_type.' '.$this->engine_cylinder.' '.$this->engine_displacement_cubicInches.' '.$this->engine_displacement;
        $data = $this->engine_displacement." ".$this->engine_block_type." ".$this->engine_cylinder;
        return $data;
    }
    // public function favouriteData()
    // {
    //     return $this->hasMany(Favourite::class,'inventory_id');
    // }

    // Define the accessor for the date_column
    public function getDateFormAttribute($value)
    {
        // Convert the VARCHAR date to the desired format
        $date = Carbon::createFromFormat('m/d/Y', $value);

        // Format the date as 'm/d/Y' and return it
        return $date->format('m/d/Y');
    }

}
