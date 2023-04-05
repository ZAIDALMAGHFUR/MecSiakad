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
        Schema::create('jadwal_pmbs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('jenis_kegiatan');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
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
        Schema::dropIfExists('jadwal_pmbs');
    }
};
