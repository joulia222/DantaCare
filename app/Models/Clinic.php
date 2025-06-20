<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    //

    protected $fillable=[
        'name',
        'code',
        'department_id',
        'created_by',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'created_by');
    }

    public function department()
    {
        return $this->belongsTo(Department::class  , 'department_id');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class , 'clinic_id');
    }



}
