<?php

namespace App\Models;

use App\Models\WarehouseProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'deleted_at'
    ];

    public function sale()
    {
        return $this->hasMany(Warehouse::class);
    }

}
