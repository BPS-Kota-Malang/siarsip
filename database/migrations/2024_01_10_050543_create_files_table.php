<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained(); // foreign key
            $table->foreignId('phase_id')->constrained();
            $table->foreignId('zone_id')->constrained();
            $table->uuid('uuid');
            $table->string('file_name')->nullable();
            $table->foreignId('user_id')->constrained(); // foreign key for user
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
