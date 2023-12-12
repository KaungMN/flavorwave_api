<?php

namespace App\Models;

use App\Models\Preorder;
use App\Models\Warehouse;
use App\Models\DamageReturnProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'photo',
    ];


    public function preorder()
    {
        return $this->hasMany(Preorder::class);
    }


    // warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }


    // damage/return
    public function damage()
    {
        return $this->belongsTo(DamageReturnProduct::class);
    }
}
