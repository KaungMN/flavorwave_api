<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
    ];

    // with customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    // with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
