<?php

namespace Database\Seeders;

use App\Models\Pendaftaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PendaftarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pendaftaran::create([
            'id_pendaftaran' => 'PSB2021-0001',
            'users_id' => 4,
            'nisn' => '1234567890',
            'nik' => '987687654321',
            'nama_siswa' => 'Maharpuan',
            'jenis_kelamin' => 'laki-laki',
            'agama' => 'islam',
            'pas_foto' => 'default.jpg',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2000-01-01',
            'no_hp' => '75765',
            'alamat' => 'Jl. Cihampelas No. 1',
            // 'provinsi' => 'jabar',
            // 'kabupaten' => 'bandung',
            // 'kecamatan' => 'bandung',
            // 'kelurahan' => 'bandung',
            'jadwal_pmbs_id' => 1,
            'tahun_masuk' => '2021',
            'pil1' => '1',
            'pil2' => '2',
            'nama_ayah' => 'Budi',
            'nama_ibu' => 'Siti',
            'pekerjaan_ayah' => 'PNS',
            'pekerjaan_ibu' => 'PNS',
            'pendidikan_ayah' => 'S1',
            'pendidikan_ibu' => 'S1',
            'nohp_ayah' => '081234567890',
            'nohp_ibu' => '081234567890',
            'penghasilan_ayah' => 'Rp. 1.000.000',
            'penghasilan_ibu' => 'Rp. 1.000.000',
            'berkas_ortu' => 'default.jpg',
            'asal_sekolah' => 'SMK Negeri 1 Bandung',
            'smt1' =>90,
            'smt2' =>90,
            'smt3' =>90,
            'smt4' =>90,
            'smt5' =>90,
            'smt6' =>90,
            'berkas_siswa' => 'default.jpg',
            'prestasi' => 'Juara 1',
            'status_pendaftaran' => '0',
            'tgl_pendaftaran' => '2021-04-06 00:00:00',
        ]);
    }
}
