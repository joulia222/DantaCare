<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'price',
        'more_info',
        'image',
        'created_by',
        'status',
    ];

    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class, 'created_by');
    }

}
