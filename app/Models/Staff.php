<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = "staffs";
    protected $fillable = [

        'role_id',
        'department_id',
        'name',
        'email',
        'photo',
        'phone',
        'summary',
        'entry_date',
        'salary',
        'deleted_at'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function scopeFilter($query,$filters){
        if($filters['search'] ?? null){
            $query
            ->where(function ($query) use ($filters){
                $query->where('name','LIKE','%'.$filters['search'].'%')
                ->orWhere('salary','LIKE','%'.$filters['search'].'%');
            });

        }
        if($filters['role'] ?? null){

                $query->whereHas('role',function($query) use ($filters) {
                    $query->where('role_name',$filters['role']);
                });


        }
        if($filters['department'] ?? null){

                $query->whereHas('department',function($query) use ($filters){
                    $query->where('name',$filters['department']);
                });
            }
        }



}
