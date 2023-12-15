<?php

namespace App\Models;

use App\Models\Preorder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $table = 'customers';
    protected $fillable = [
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




    public function preorder()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeFilter($query, $filters)
    {
        if ($filters['name'] ?? null) {
            $query
                ->where(function ($query) use ($filters) {
                    $query->where('name', 'LIKE', '%' . $filters['name'] . '%');
                });
        }
        if ($filters['price'] ?? null) {
            $query
                ->where(function ($query) use ($filters) {
                    $query->where('price', 'LIKE', '%' . $filters['price'] . '%');
                });
        }
    }
}
