<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'Name', 'Code'
    ];

    // Division.php

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

}
