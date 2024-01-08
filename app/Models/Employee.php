<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'division_id',
        'NIP',
        'user_id',
        'pangkat',
    ];



    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Division()
    {
        return $this->belongsTo(Division::class);
    }
}
