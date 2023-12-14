<?php

namespace App;

use App\Models\Customer;
use App\Models\Subscriber;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'subscriber_id',
        'user_name',
        'phone',
        'password',
        'role',
        'email_verification_code',
        'address',
        'zip_code',
        'city',
        'country',
        'description',
        'phone_verification_code',
        'is_phone_verified',
        'status',
        'is_social_login',
        'social_network_id',
        'social_network_type',
        'blood_group',
        'last_blood_donate_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id', 'id');
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'subscriber_id', 'id');
    }
}
