<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todos extends Model
{
    use HasFactory;
    protected $table = 'todos';//kenalin models yg ga sesuai aturan laravel(harus huruf kapital+jangan pake s diakhir kalimat)
    protected $fillable = [
        'title',
        'description',
        'date',
        'user_id',
        'status',
        'done_time',
    ];
}
