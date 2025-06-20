<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class StoreKeeperEmployee extends Authenticatable
{
    //
    protected $guard = ['storeKeeperEmployee'];

    protected $fillable=[
        'name',
        'email',
        'password',
        'gender',
        'status',
        'age',
        'phone',
        'img',
        'created_by',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by');
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
