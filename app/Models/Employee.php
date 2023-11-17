<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'gender', 'phone', 'email',
    ];

    public function detail()
    {
        return $this->hasOne(EmployeeDetail::class);
    }
}
