<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
