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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('preview_link'); // Tambahkan tanda kutip pada nama kolom
            $table->string('download_link'); // Tambahkan tipe data pada kolom
            $table->string('kegiatan'); // Tambahkan tipe data dan unsigned pada kolom // Tambahkan tipe data dan unsigned pada kolom
            $table->timestamps();

            // Tambahkan indeks untuk foreign key
            // $table->foreign('id_kegiatan')->references('id')->on('kegiatan');
            // $table->foreign('id_user')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
