<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NurseWorkHour extends Model
{
    //
    protected $fillable = [
        'nurse_id', 
        'date', 
        'start_time', 
        'end_time',
        'created_by'
    ];

    public function nurse()
    {
        return $this->belongsTo(Nurse::class , 'nurse_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class , 'created_by');
    }
}
