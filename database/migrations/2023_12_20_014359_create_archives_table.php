<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained(); // foreign key
            $table->string('preview_link');
            $table->string('download_link');
            // ... tambahkan kolom lain sesuai kebutuhan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('archives');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
};
