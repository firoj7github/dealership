<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;
    protected $table = 'vehicle_model';
    public $timestamps = false;
    protected $fillable = ['vehicle_model_id','vehicle_make_id','vehicle_model'];
}
