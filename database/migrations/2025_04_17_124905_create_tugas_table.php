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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id('id_tugas');
            $table->String('judul', 255);
            $table->String('deskripsi', 255);
            $table->date('deadline', 255);
            $table->enum('status', ['pending', 'selesai', 'tidak mengerjakan']);
            $table->String('file_tugas')->nullable();
            $table->unsignedBigInteger('id_mahasiswa')->index();
            $table->unsignedBigInteger('id_matkul')->index();

            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_matkul')->references('id_matkul')->on('matakuliah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
