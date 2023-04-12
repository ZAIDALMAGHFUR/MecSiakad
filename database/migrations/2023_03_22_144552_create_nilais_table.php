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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_academic_id');
            $table->foreign('tahun_academic_id')->references('id')->on('tahun_academics')->onDelete('cascade');
            $table->unsignedBigInteger('mahasiswas_id');
            $table->foreign('mahasiswas_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->string('tugas');
            $table->string('kuis');
            $table->string('partisipasi_pembelajaran');
            $table->string('uts');
            $table->string('uas');
            $table->string('nilai_akhir');
            $table->unsignedBigInteger('mata_kuliahs_id')->nullable();
            $table->foreign('mata_kuliahs_id')->references('id')->on('mata_kuliahs')->onDelete('cascade');
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
        Schema::dropIfExists('nilais');
    }
};
