<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable implements JWTSubject
{
    use HasFactory , Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'img',
        'gender'
    ];
    protected $hidden = [
        'password'
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
