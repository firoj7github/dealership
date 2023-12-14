<?php

namespace App\Models;
use App\Models\DealerInfo;
use App\Models\InventoryMediaInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Inventory extends Model
{

    use HasFactory ,SoftDeletes;
    protected $fillable =['id','dealer_info_id','user_id','is_feature','condition','stock','vin','year','make','model','body','trim','model_number','doors','exterior_color','interior_color','engine_cylinder','engine_displacement','transmission','miles','price','retails','book_value','invoice','certified','date_in_stock','description','options','categorized_options','drive_train','fuel','mpg_city','mpg_hwy','ext_color_generic','ext_color_code','int_color_generic','int_color_code','engine_block_type','transmission_speed','passenger_capacity','ext_color_hex_Code','image_from_url','stock_date_formated','payment_price','body_formated','status','package','is_feature','payment_date','active_till','featured_till','is_visibility'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getTitleAttribute()
    {
        // return $this->year.' '.$this->make.' '.$this->model.' '.$this->trim.' '.$this->body;
        return $this->year.' '.$this->make.' '.$this->model.' '.$this->trim;
    }
    public function getCategoryAttribute()
    {
        // return $this->year.' '.$this->make.' '.$this->model.' '.$this->trim.' '.$this->body;
        return $this->make.'/'.$this->model;
    }
    public function getTitleWithBodyAttribute()
    {
        return $this->year.' '.$this->make.' '.$this->model.' '.$this->trim.' '.$this->body;
        // return $this->year.' '.$this->make.' '.$this->model.' '.$this->trim;
    }

    public function getImageAttribute()
    {
        $image = explode(',', $this->image_from_url);
        // $img = (($image[0])) ?
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
        $price = $this->price != 0 ? '$'.number_format($this->price, 0, '.', ',') : 'Email for price';
        return $price;
    }
    public function getInvoiceFormateAttribute()
    {
        $price = $this->price != 0 ? number_format($this->invoice, 0, '.', ',') : 'Email for price';
        return $price;
    }

    public function getMilesFormateAttribute()
    {
        $price = number_format($this->miles, 0, '.', ',' );
        return $price;
    }

    // public function getdealerAddressFormateAttribute()
    // {
    //     $dealer_address = $this->dealers->dealer_city.', '.$this->dealers->dealer_state.'.';
    //     return $dealer_address;
    // }

    public function getEngineDescriptionFormateAttribute()
    {
        // $data = $this->engine_block_type.' '.$this->engine_cylinder.' '.$this->engine_displacement_cubicInches.' '.$this->engine_displacement;
        $data = $this->engine_displacement." ".$this->engine_block_type." ".$this->engine_cylinder;
        return $data;
    }

    // Define the accessor for the date_column
    public function getDateFormAttribute($value)
    {
        // Convert the VARCHAR date to the desired format
        $date = Carbon::createFromFormat('m/d/Y', $value);

        // Format the date as 'm/d/Y' and return it
        return $date->format('m/d/Y');
    }

    public function dealers()
    {
        return $this->belongsTo(DealerInfo::class,'dealer_info_id');
    }

    public function mediaInfo()
    {
        return $this->hasOne(InventoryMediaInfo::class, 'inventory_id');
    }
    
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
