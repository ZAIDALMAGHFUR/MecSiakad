<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumumen', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengumuman')->unique();
            $table->string('id_pendaftaran');
            $table->string('users_id')->nullable();
            $table->string('hasil_seleksi')->nullable();
            $table->unsignedBigInteger('prodi_penerima')->nullable();
            $table->foreign('prodi_penerima')->references('id')->on('program_studies')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->integer('nilai_interview')->nullable();
            $table->integer('nilai_test')->nullable();
            // $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengumumen');
    }
};
