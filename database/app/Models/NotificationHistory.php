<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationHistory extends Model
{
    protected $fillable = [
        'customer_id',
        'notification_type',
        'notification_details',
        'number_of_users',
        'credit_used'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
