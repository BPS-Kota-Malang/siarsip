<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use \Znck\Eloquent\Traits\BelongsToThrough;

class Archive extends Model
{
    use HasFactory;

    protected $table = "archives";
    protected $primaryKey = "id";
    protected $fillable = ['activity_id', 'phase', 'user_id', 'preview_link', 'file_content', 'download_link'];


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

    public function activity() : BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function division() {
        return $this->BelongsToThrough(User::class, Employee::class);
    }
}
