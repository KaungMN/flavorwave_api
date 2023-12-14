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

    public function scopeFilter($query,$filters){
        if($filters['name'] ?? null){

            $query->whereHas('product',function($query) use ($filters) {
                $query->where('name',$filters['name']);
            });

        }
        if($filters['price'] ?? null){
            $query->whereHas('product',function($query) use ($filters) {
                $query->where('price',$filters['price']);
            });
        }
    }
}
