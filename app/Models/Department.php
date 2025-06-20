<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //

    protected $fillable=[
        'name',
        'code',
        'created_by',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function clinic()
    {
        return $this->hasMany(Clinic::class , 'department_id');
    }

    public function doctor()
    {
        return $this->hasMany(Doctor::class , 'department_id');
    }
}
