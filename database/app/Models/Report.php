<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'subscriber_id',
        'donor_id',
        'present_volunteer_id',
        'responsible_volunteer_id',
        'name_of_patient',
        'name_of_hospital',
        'contact_number',
        'description',
        'status',
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donor_id', 'id');
    }

    public function presentVolunteer()
    {
        return $this->belongsTo(User::class, 'present_volunteer_id', 'id');
    }

    public function responsibleVolunteer()
    {
        return $this->belongsTo(User::class, 'responsible_volunteer_id', 'id');
    }
}
