<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    //
    protected $fillable = [
         'name',
         'patient_id',
         'created_by'
        ];

    public function patient()
    {
        return $this->belongsTo(Patient::class , 'patient_id');
    }

    public function reception()
    {
        return $this->belongsTo(Receptionist::class , 'created_by');
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class , 'medical_record_id');
    }
}
