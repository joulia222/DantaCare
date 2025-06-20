<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiography extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 
        'image', 
        'image_date',
        'description',
    ];

    protected $casts = [
        'image_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class , 'patient_id');
    }
}
