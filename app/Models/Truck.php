<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'truckNum',
        'truck_name',
        'capacity',
        'deleted_at'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function scopeFilter($query,$filters){
        // 'staff','truck_number','truck_name','capacity'
        if($filters['staff'] ?? null){
            $query->whereHas('staff',function($query) use ($filters) {
                $query->where('name',$filters['staff']);
            });

        }

        if($filters['search'] ?? null){

            $query
            ->where(function ($query) use ($filters){
                $query->where('truck_name','LIKE','%'.$filters['search'].'%')
                ->orWhere('truck_number','LIKE','%'.$filters['search'].'%')
                ->orWhere('capacity','LIKE','%'.$filters['search'].'%');
            });


        }
    }
}
