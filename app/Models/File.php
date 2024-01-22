<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function activity() : BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function zone() : BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function phase() : BelongsTo
    {
        return $this->belongsTo(Phase::class);
    }

}
