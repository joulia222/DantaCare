<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    //
    protected $fillable = 
    [
      'name',
      'date_time',
      'result',
      'medicine',
      'next_inspection_date',
      'medical_record_id',
      'doctor_id'
    ];

    protected $casts = [
        'date_time' => 'datetime',
        'next_inspection_date' => 'date'
    ];

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    
}
