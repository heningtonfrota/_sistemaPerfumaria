<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable=[ 
        'ml_perfume', 
        'ml_alcohol', 
        'ml_fragrance', 
        'name_fragrance',
    ];
}
