<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Preorder;
use App\Models\Warehouse;
use App\Models\RawMaterial;
use App\Models\DamageReturnProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'photo',
        'price',
        'description',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('/img/product' . $this->photo);
    }

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


    // with cart
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    // with raw
    public function raw()
    {
        return $this->hasMany(RawMaterial::class);
    }
}
