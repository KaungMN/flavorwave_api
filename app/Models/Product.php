<?php

namespace App\Models;

use App\Models\Preorder;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'name',
        'photo',
        'price',
    ];


    public function preorder()
    {
        return $this->hasMany(Preorder::class);
    }


    // warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
