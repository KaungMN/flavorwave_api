<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'name',
        'price',
        'photo',
        'weight',
        'demand_date',
    ];


    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }
}
