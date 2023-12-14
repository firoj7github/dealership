<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'customer_id',
        'subscription_package_id',
        'start_date',
        'end_date',
        'color_1',
        'color_2',
        'logo',
        'image',
        'credit',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function subscriptionPackage()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'subscription_package_id', 'id');
    }
}
