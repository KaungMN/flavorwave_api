<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ManufacturedProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RawMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'product_id',
        'name',
        'price',
        'photo',
        'weight',
        'demand_date',
        'deleted_at'
    ];

    // one to many
    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }


    public function manufacturedProduct()
    {
        return $this->belongsTo(ManufacturedProduct::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class,);
    }
}
