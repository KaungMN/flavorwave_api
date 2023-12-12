<?php

namespace App\Models;

use App\Models\Preorder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'password',
        'email',
        'city',
        'township',
        'address',
        'phone',
        'customerType',
        'deleted_at'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function preorder()
    {
        return $this->hasMany(Preorder::class);
    }
}
