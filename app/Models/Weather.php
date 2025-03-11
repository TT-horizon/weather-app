<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $table = 'weather';

    protected $fillable = ['city', 'date', 'data'];

    protected $casts = [
        'data' => 'array', // JSONとして保存・取得する
    ];
}
