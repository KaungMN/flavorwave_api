<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'truck_number',
        'truck_name',
        'capacity',
        'deleted_at'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
