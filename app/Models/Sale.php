<?php

namespace App\Models;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'preorder_ids',
        'staff_id',
        'deleted_at'
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

    public function staff(){
        return $this->belongsTo(Staff::class);
    }

    // public function scopeFilter($query,$filters){

    //     if($filters['staff'] ?? null){
    //         $query->whereHas('staff',function($query) use ($filters) {
    //             $query->where('name',$filters['staff']);
    //         });
    //     }

    //     if($filters['product'] ?? null){
    //         $query->whereHas('product',function($query) use ($filters) {
    //             $query->where('name',$filters['product']);
    //         });
    //     }


    // }
}
