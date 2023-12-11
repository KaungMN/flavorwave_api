<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'raw_id',
        'product_id',
        'supplier_id',
        'line',
        'expire_date'
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function rawMaterial()
    {
        return $this->hasMany(RawMaterial::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
