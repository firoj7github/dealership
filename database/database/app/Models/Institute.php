<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $fillable = ['subscriber_id', 'name', 'district', 'upozila', 'status'];
}
