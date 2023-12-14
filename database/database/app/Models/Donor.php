<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'subscriber_id',
        'added_by',
        'name',
        'phone',
        'blood_group',
        'district',
        'upozila',
        'last_blood_donate_date',
        'gender',
        'image',
        'institution'
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }

    public function institutionName()
    {
        return $this->belongsTo(Institute::class, 'institution', 'id');
    }
}
