<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPackage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'number_of_locations',
        'number_of_calendars',
        'status'
    ];

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class, 'subscription_package_id', 'id');
    }
}
