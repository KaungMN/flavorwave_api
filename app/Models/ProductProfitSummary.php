<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductProfitSummary extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product_profit_summary';

    protected $guarded = [];

}
