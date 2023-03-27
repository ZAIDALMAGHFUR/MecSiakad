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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nim');
            $table->string('email');
            $table->foreignId('user_id')->constrained();
            $table->string('no_hp');
            $table->string('alamat');
            $table->foreignId('program_studies_id')->constrained();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['laki-laki','perempuan']);
            $table->enum('agama', ['islam','kristen','katolik','hindu','budha','konghucu']);
            $table->enum('status', ['aktif','tidak aktif','lulus','drop out','alumni']);
            $table->string('tahun_masuk');
            $table->string('tahun_lulus')->nullable();
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->string('no_hp_ortu');
            $table->string('alamat_ortu');
            $table->string('asal_sekolah');
            $table->string('foto');
            $table->foreignId('tahun_academics_id')->constrained('tahun_academics');
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
        Schema::dropIfExists('mahasiswas');
    }
};
