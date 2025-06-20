<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalSupplies extends Model
{
    //

    protected $fillable = [
        'name',
        'code',
        'type',
        'description',
        'quantity',
        'image',
        'created_by'
    ];

    public function storeKeeperEmployee()
    {
        return $this->belongsTo(StoreKeeperEmployee::class , 'created_by');
    }
}
