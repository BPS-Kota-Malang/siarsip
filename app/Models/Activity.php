<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;
    protected $table = "activities";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'name', 'finance_code', 'division_id'
    ];

    public function archives() : HasMany
    {
        // return $this->hasMany(Activity::class, 'activity_id');
        return $this->hasMany(Archive::class);
    }

    public function division() : BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
