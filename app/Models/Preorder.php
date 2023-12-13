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
        'quantity',
        'sub_total',
        'products',
        'city',
        'township',
        'address',
        'orderType',
        'status',
        'remark',
        'delivery_date',
        'deleted_at'
    ];

    //one to many
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    //many to many
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
