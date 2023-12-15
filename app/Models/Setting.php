<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
    'department_id',
        'target_year',
        'total_budget',
        'report_budget',
        'deleted_at'
    ];

    // one to many
    public function department()
    {
        return $this->hasMany(Department::class);
    }
}
