<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = [
        'role_id',
        'department_id',
        'name',
        'email',
        'photo',
        'phone',
        'summary',
        'entry_date',
        'password',
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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
