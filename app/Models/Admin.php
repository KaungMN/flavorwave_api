<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'sold_count',
        'produced_count',
        'cancel_count',
        'current_price',
        'initial_price'
    ];
}
