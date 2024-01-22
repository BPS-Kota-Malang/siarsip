<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Phase extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function archives() : HasMany
    {
        // return $this->hasMany(Activity::class, 'activity_id');
        return $this->hasMany(Archive::class);
    }

    public function file() : HasMany
    {
        // return $this->hasMany(Activity::class, 'activity_id');
        return $this->hasMany(File::class);
    }
}
