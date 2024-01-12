<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'code'
    ];

    public function employees() : HasMany
    {
        return $this->hasMany(Employee::class);
    }
    // Division.php

    public function activities() : HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Employee::class);
    }

}
