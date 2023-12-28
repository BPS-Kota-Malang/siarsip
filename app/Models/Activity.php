<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = "activities";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'name', 'division'
    ];

    public function archives()
    {
        return $this->hasMany(Activity::class, 'activity_id');
        return $this->hasMany(Archive::class, 'activity_id');
    }
}
