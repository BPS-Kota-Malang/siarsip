<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Archive extends Model
{
    use HasFactory;

    protected $table = "archives";
    protected $primaryKey = "id";
    protected $fillable = [
        'activity_id', 'preview_link', 'phase', 'file_content' // tambahkan download_link pada fillable
    ];

    protected static $enumCache = [];

    public static function getPossibleEnumValues($column)
    {
        $instance = new static;

        if (!isset(self::$enumCache[$column])) {
            $enumValues = [];

            // Menggunakan query langsung untuk mendapatkan nilai-nilai enum
            $type = DB::select("SHOW COLUMNS FROM {$instance->getTable()} WHERE Field = '{$column}'")[0]->Type;

            preg_match('/^enum\((.*)\)$/', $type, $matches);

            $enumValues = array_map(
                'trim',
                explode(',', str_replace("'", '', $matches[1]))
            );

            // Simpan hasil dalam cache
            self::$enumCache[$column] = $enumValues;
        }

        return self::$enumCache[$column];
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
