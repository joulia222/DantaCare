<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    //
    protected $fillable=[
        'name',
        'email',
        'password',
        'gender',
        'status',
        'age',
        'phone',
        'img',
        'department_id',
        'created_by',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function depatrment()
    {
        return $this->belongsTo(Department::class , 'department_id');
    }
}
