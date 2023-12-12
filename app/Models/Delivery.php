<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'truck_id',
        'preorder_id',
        'delivery_date',
        'status'
    ];

    //one to many
    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }


    public function preorder()
    {

        return $this->hasMany(Preorder::class);
    }
}
