<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArchivedTmpInventories extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'archived_tmp_inventories';
    protected $guarded = ['id'];
}
