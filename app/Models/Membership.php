<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Membership extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['membership_type', 'membership_price', 'status'];
}
