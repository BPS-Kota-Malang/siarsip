<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name'
    ];

    public function Employee()
    {
        return $this->hasMany(Employee::class);
    }
}
