<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LeadMessage extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['lead_id', 'sender_id', 'receiver_id', 'message', 'is_seen', 'file', 'report_history'];

    public function user()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id');
    }
    public function lead()
    {
        return $this->belongsTo(Lead::class,'lead_id');
    }


}
