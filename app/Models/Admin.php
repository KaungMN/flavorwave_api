<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'sold_count',
        'product_id',
        'manufactured_product_id',
        'sold_count',
        'target_year',
        'produced_count',
        'cancel_count',

    ];
}
