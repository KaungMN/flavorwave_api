<?php

namespace App\Models;

use App\Models\RawMaterial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManufacturedProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'raw_id',
        'product_id',
        'total_amount',
    ];


    public function raw()
    {
        return $this->hasMany(RawMaterial::class);
    }
}
