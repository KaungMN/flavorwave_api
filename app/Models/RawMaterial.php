<?php

namespace App\Models;

use App\Models\ManufacturedProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RawMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'name1',
        'price1',
        'photo1',
        'weight1',
        'name2',
        'price2',
        'photo2',
        'weight2',
        'name3',
        'price3',
        'photo3',
        'weight3',
        'name4',
        'price4',
        'photo4',
        'weight4',
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
}
