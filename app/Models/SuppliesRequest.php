<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuppliesRequest extends Model
{
    //

    protected $fillable = [
        'type',
        'change_status_by',
        'doctor_id',
        'quantity',
        'status' ,
        'reject_cause',
        'taken_date',
        're_entry_date',
        'is_return_in_date',
        'medical_supplies_id',
    ];

    public function storeKeeperEmployee()
    {
        return $this->belongsTo(StoreKeeperEmployee::class , 'change_status_by');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class , 'doctor_id');
    }

    public function medicalSupplies()
    {
        return $this->belongsTo(MedicalSupplies::class , 'medical_supplies_id');
    }

}
