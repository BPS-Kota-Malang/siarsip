<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function Employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function sluggable(): array
    {
        return [
            'username' => [
                'source' => 'email'
            ]
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'superadmin'; // Gantilah dengan logika peran sesuai kebutuhan aplikasi Anda
    }

    public function isTeamLeader()
    {
        return $this->role === 'ketuatim';
    }

    public function isMember()
    {
        return $this->role === 'anggota';
    }
}
