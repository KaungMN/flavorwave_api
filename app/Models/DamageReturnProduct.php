<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DamageReturnProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'quantity',
        'remark',
        'stage'
    ];


    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
