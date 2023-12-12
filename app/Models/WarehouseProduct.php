<?php

namespace App\Models;

use App\Models\ManufacturedProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WarehouseProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'line',
        'expire_date',
        'manufactured_product_id',
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

    public function manufactproduct()
    {
        return $this->hasMany(ManufacturedProduct::class);
    }
}
