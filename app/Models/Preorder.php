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
        'city',
        'township',
        'address',
        'orderType',
        'status',
        'remark',
        'deleted_at',
        'delivery_date'
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

    public function scopeFilter($query,$filters){
        if($filters['status'] ?? null){

            $query
            ->where(function ($query) use ($filters){
                $query->where('status','LIKE','%'.$filters['status'].'%');

            });

        }
        if($filters['customer'] ?? null){
            $query->whereHas('customer',function($query) use ($filters) {
                $query->where('name',$filters['customer']);
            });
        }

        if($filters['product'] ?? null){
            $query->whereHas('product',function($query) use ($filters) {
                $query->where('name',$filters['product']);
            });
        }


    }
}
