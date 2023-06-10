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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('id_pendaftaran')->unique();
            $table->foreignId('users_id')->constrained();
            $table->string('nisn');
            $table->string('nik');
            $table->string('nama_siswa');
            $table->enum('jenis_kelamin', ['laki-laki','perempuan']);
            $table->enum('agama', ['islam','kristen','katolik','hindu','budha','konghucu']);
            $table->string('pas_foto');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_hp');
            $table->string('alamat');
            // $table->string('provinsi');
            // $table->string('kabupaten');
            // $table->string('kecamatan');
            // $table->string('kelurahan');
            $table->foreignId('jadwal_pmbs_id')->constrained();
            $table->string('tahun_masuk');
            // $table->unsignedBigInteger('pil1')->nullable();
            // $table->foreign('pil1')->references('id')->on('program_studies')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('pil2')->nullable();
            // $table->foreign('pil2')->references('id')->on('program_studies')->onUpdate('cascade')->onDelete('cascade');
            $table->string('pil1');
            $table->string('pil2');

            //data orang tua
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('nohp_ayah')->nullable();
            $table->string('nohp_ibu')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('berkas_ortu')->nullable();//kk akte ijazah raport penghasilan

            //data sekolah
            $table->string('asal_sekolah');
            $table->double('smt1')->nullable();
            $table->double('smt2')->nullable();
            $table->double('smt3')->nullable();
            $table->double('smt4')->nullable();
            $table->double('smt5')->nullable();
            $table->double('smt6')->nullable();
            $table->string('berkas_siswa');//kk akte ijazah raport penghasilan
            $table->string('prestasi')->nullable();
            $table->string('status_pendaftaran');
            $table->datetime('tgl_pendaftaran');
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
        Schema::dropIfExists('pendaftarans');
    }
};
