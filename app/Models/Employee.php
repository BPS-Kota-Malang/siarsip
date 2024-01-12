<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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



    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function division() : BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
