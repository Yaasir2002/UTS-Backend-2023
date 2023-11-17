<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    protected $fillable = [
        'address', 'status', 'hired_on'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
