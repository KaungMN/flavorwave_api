<?php

namespace App\Models;

use App\Models\WarehouseProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_id',
        'slug',
        'name',
        'adddress',
        'phone'
    ];

    public function sale()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function warehouseproduct()
    {
        return $this->hasMany(WarehouseProduct::class);
    }
}
