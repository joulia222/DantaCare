<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    //
    protected $guard = 'patient';
    protected $fillable=[
        'name',
        'email',
        'password',
        'gender',
        'status',
        'age',
        'phone',
        'img',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function radiographies()
    {
        return $this->hasMany(Radiography::class , 'patient_id');
    }

    
     /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
