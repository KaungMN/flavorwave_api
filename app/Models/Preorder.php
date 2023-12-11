<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'box_pcs',
        'slug',
        'city',
        'township',
        'address',
        'orderType',
        'status',
        'remark'
    ];

    //one to many
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    //many to many
    public function products(){
        return $this->hasMany(Product::class);
    }
}
