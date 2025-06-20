<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Doctor extends Authenticatable
{
    //
    protected $guard = 'doctor';

    protected $fillable=[
        'name',
        'email',
        'password',
        'gender',
        'status',
        'age',
        'phone',
        'img',
        'specialization_id',
        'department_id',
        'created_by',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function specialization()
    {
         return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class , 'department_id');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class , 'doctor_id');
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
