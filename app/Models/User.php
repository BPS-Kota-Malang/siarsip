<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Znck\Eloquent\Traits\BelongsToThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;


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
        'role',
        'username',
        'password',
    ];

    protected static $enumCache = [];

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

    public function divisionEmployee() : HasOneThrough
    {
        return $this->hasOneThrough( Division::class, Employee::class);
    }

    public function sluggable(): array
    {
        return [
            'username' => [
                'source' => 'email'
            ]
        ];
    }

    public static function getPossibleEnumValues($column)
    {
        $instance = new static;

        if (!isset(self::$enumCache[$column])) {
            $enumValues = [];

            // Menggunakan query langsung untuk mendapatkan nilai-nilai enum
            $type = DB::select("SHOW COLUMNS FROM {$instance->getTable()} WHERE Field = '{$column}'")[0]->Type;

            preg_match('/^enum\((.*)\)$/', $type, $matches);

            $enumValues = array_map(
                'trim',
                explode(',', str_replace("'", '', $matches[1]))
            );

            // Simpan hasil dalam cache
            self::$enumCache[$column] = $enumValues;
        }

        return self::$enumCache[$column];
    }

    public function isSuperAdmin()
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
