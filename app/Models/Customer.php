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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function preorder()
    {
        return $this->hasMany(Preorder::class);
    }

    // search
    public function scopeFilter($query, $filters)
    {
        if ($filters['search'] ?? null) {
            $query
                ->where(function ($query) use ($filters) {
                    $query->where('title', 'LIKE', '%' . $filters['search'] . '%')
                        ->orWhere('description', 'LIKE', '%' . $filters['search'] . '%');
                });
        }
        if ($filters['category'] ?? null) {

            $query->whereHas('category', function ($query) use ($filters) {
                $query->where('slug', $filters['category']);
            });
        }
        if ($filters['author'] ?? null) {

            $query->whereHas('author', function ($query) use ($filters) {
                $query->where('username', $filters['author']);
            });
        }
    }
}
