<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class register extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'date',
        'user_id',
        'status',
        'done_time',
    ];
}
