<?php

namespace App\Models;

use App\Models\RawMaterial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManufacturedProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'raw_material_id',
        'product_id',
        'product_price',
        'release_date',
        'total_quantity',
        'deleted_at'
    ];


    public function raw()
    {
        return $this->hasMany(RawMaterial::class);
    }
}
