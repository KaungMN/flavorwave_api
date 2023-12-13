<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

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
