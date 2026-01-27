<?php

namespace App\Models;

use App\Policies\AddressPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

#[UsePolicy(AddressPolicy::class)]
class Address extends Authenticatable implements JWTSubject
{
    use HasFactory , Notifiable;
    protected $fillable = [
        'student_id',
        'name',
        'details',
        'country',
        'city',
        'governorate',
        'flag',
    ];

    protected $casts = [
        'flag' => 'boolean',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
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
