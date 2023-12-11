<?php

namespace App\Models;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'preorder_id',
        'staff_id',
        'status',
    ];

    // one to many
    public function preorder()
    {
        return $this->hasMany(Preorder::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
