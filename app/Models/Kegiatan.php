<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = "activity";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'name', 'finance_code', 'division'
    ];
}
