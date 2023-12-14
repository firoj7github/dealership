<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'vat_number',
        'comment',
        'password_text',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function clinic()
    {
        return $this->hasOne(Clinic::class, 'customer_id', 'id');
    }

    public function subscriber()
    {
        return $this->hasOne(Subscriber::class, 'customer_id', 'id');
    }
}
