<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    // 'customer_id' => $request->customer_id,
    //         'products' => $request->input('products'),
    //         'quantity' => $request->quantity,
    //         'city' => $request->city,
    //         'township' => $request->township,
    //         'address' => $request->address,
    //         'orderType' => $request->orderType,
    //         'status' => $request->status,
    //         'remark' => $request->remark,

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_email',
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
        return $this->hasMany(Product::class);
    }

    public function scopeFilter($query, $filters)
    {
        if ($filters['status'] ?? null) {

            $query
                ->where(function ($query) use ($filters) {
                    $query->where('status', 'LIKE', '%' . $filters['status'] . '%');
                });
        }
        if ($filters['customer'] ?? null) {
            $query->whereHas('customer', function ($query) use ($filters) {
                $query->where('name', $filters['customer']);
            });
        }

        if ($filters['product'] ?? null) {
            $query->whereHas('product', function ($query) use ($filters) {
                $query->where('name', $filters['product']);
            });
        }
    }
}
