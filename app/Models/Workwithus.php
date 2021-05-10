<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workwithus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'work_with_us';
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];
}
