<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
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
        'customerType'
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }



}
