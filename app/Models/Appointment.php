<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $fillable =[
        'clinic_id',
        'patient_id',
        'start_time',
        'end_time',
        'day',
        'doctor_id',
        'status',
        ];

        public function patient()
        {
            return $this->belongsTo(Patient::class , 'patient_id');
        }

        public function clinic()
        {
            return $this->belongsTo(Clinic::class, 'clinic_id');
        }

        public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
