<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
    use HasFactory;

    protected $fillable=[
        'name', 
        'ml_perfume', 
        'ml_alcohol', 
        'ml_fragrance', 
        'name_fragrance', 
        'ml_most_used_fragrance', 
        'amount_created', 
        'quantity_available_for_breeding'
    ];
}
