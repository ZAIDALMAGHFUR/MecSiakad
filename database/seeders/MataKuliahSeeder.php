<?php

namespace Database\Seeders;

use App\Models\Mata_Kuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Pendidikan Agama Islam',
            'kode_mata_kuliah' => 'TK2101',
            'sks' => 2,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);

        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Kewarganegaraan',
            'kode_mata_kuliah' => 'TK2102',
            'sks' => 2,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);

        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Bahasa Indonesia',
            'kode_mata_kuliah' => 'TK2103',
            'sks' => 2,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Bahasa Inggris I',
            'kode_mata_kuliah' => 'TK2104',
            'sks' => 2,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Fisika',
            'kode_mata_kuliah' => 'TK2105',
            'sks' => 2,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Kimia Dasar',
            'kode_mata_kuliah' => 'TK2106',
            'sks' => 2,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Matematika Teknik',
            'kode_mata_kuliah' => 'TK2107',
            'sks' => 3,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Kimia Analisa',
            'kode_mata_kuliah' => 'TK2108',
            'sks' => 3,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktikum Fisika',
            'kode_mata_kuliah' => 'TK2109',
            'sks' => 1,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktikum Kimia',
            'kode_mata_kuliah' => 'TK2110',
            'sks' => 1,
            'semester' => 1,
            'program_studies_id' => 1,
        ]);

        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Pemrograman Komputer',
            'kode_mata_kuliah' => 'TK2201',
            'sks' => 2,
            'semester' => 2,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Kewirausahaan',
            'kode_mata_kuliah' => 'TK2202',
            'sks' => 3,
            'semester' => 2,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Pengetahuan Lingkungan',
            'kode_mata_kuliah' => 'TK2203',
            'sks' => 3,
            'semester' => 2,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Statistik',
            'kode_mata_kuliah' => 'TK2204',
            'sks' => 3,
            'semester' => 2,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Menggambar Teknik',
            'kode_mata_kuliah' => 'TK2205',
            'sks' => 2,
            'semester' => 2,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Bahasa Inggris II',
            'kode_mata_kuliah' => 'TK2206',
            'sks' => 2,
            'semester' => 2,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Kimia Organik',
            'kode_mata_kuliah' => 'TK2207',
            'sks' => 2,
            'semester' => 2,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Teknologi Bahan',
            'kode_mata_kuliah' => 'TK2208',
            'sks' => 2,
            'semester' => 2,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktikum Statistik',
            'kode_mata_kuliah' => 'TK2209',
            'sks' => 1,
            'semester' => 2,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktikum Komputer',
            'kode_mata_kuliah' => 'TK2210',
            'sks' => 1,
            'semester' => 2,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktikum Kimia Organik',
            'kode_mata_kuliah' => 'TK2211',
            'sks' => 1,
            'semester' => 2,
            'program_studies_id' => 1,
        ]);

        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Ekonomi Teknik',
            'kode_mata_kuliah' => 'TK2301',
            'sks' => 2,
            'semester' => 3,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Thermodinamika',
            'kode_mata_kuliah' => 'TK2302',
            'sks' => 2,
            'semester' => 3,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Perencanaan Tata Letak Pabrik',
            'kode_mata_kuliah' => 'TK2303',
            'sks' => 2,
            'semester' => 3,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Bahasa Jepang',
            'kode_mata_kuliah' => 'TK2304',
            'sks' => 2,
            'semester' => 3,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Azas Teknik Kimia',
            'kode_mata_kuliah' => 'TK2305',
            'sks' => 3,
            'semester' => 3,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Bio Proses',
            'kode_mata_kuliah' => 'TK2306',
            'sks' => 2,
            'semester' => 3,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Operasi Teknik Kimia I',
            'kode_mata_kuliah' => 'TK2307',
            'sks' => 3,
            'semester' => 3,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Instrumentasi Kimia',
            'kode_mata_kuliah' => 'TK2308',
            'sks' => 2,
            'semester' => 3,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktikum Kimia Analisa',
            'kode_mata_kuliah' => 'TK2309',
            'sks' => 1,
            'semester' => 3,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktikum Bio Proses',
            'kode_mata_kuliah' => 'TK2310',
            'sks' => 1,
            'semester' => 3,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Teknik Reaksi Kimia',
            'kode_mata_kuliah' => 'TK2401',
            'sks' => 3,
            'semester' => 4,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Peristiwa Perpindahan Panas',
            'kode_mata_kuliah' => 'TK2402',
            'sks' => 3,
            'semester' => 4,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Teknik Operasi Pabrik I',
            'kode_mata_kuliah' => 'TK2403',
            'sks' => 3,
            'semester' => 4,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Utilitas',
            'kode_mata_kuliah' => 'TK2404',
            'sks' => 2,
            'semester' => 4,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Operasi Teknik Kimia II',
            'kode_mata_kuliah' => 'TK2405',
            'sks' => 3,
            'semester' => 4,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Alat Industri Kimia',
            'kode_mata_kuliah' => 'TK2406',
            'sks' => 3,
            'semester' => 4,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Industri Proses Kimia',
            'kode_mata_kuliah' => 'TK2407',
            'sks' => 3,
            'semester' => 4,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktikum Utilitas',
            'kode_mata_kuliah' => 'TK2408',
            'sks' => 1,
            'semester' => 4,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktikum Operasi Teknik Kimia',
            'kode_mata_kuliah' => 'TK2409',
            'sks' => 1,
            'semester' => 4,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Teknik Tenaga Listrik',
            'kode_mata_kuliah' => 'TK2501',
            'sks' => 2,
            'semester' => 5,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Metodologi Penelitian',
            'kode_mata_kuliah' => 'TK2502',
            'sks' => 2,
            'semester' => 5,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Kesehatan & Keselamatan Kerja',
            'kode_mata_kuliah' => 'TK2503',
            'sks' => 3,
            'semester' => 5,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Teknik Air Buangan Industri',
            'kode_mata_kuliah' => 'TK2504',
            'sks' => 3,
            'semester' => 5,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Neraca Massa & Energi',
            'kode_mata_kuliah' => 'TK2505',
            'sks' => 2,
            'semester' => 5,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Teknik Operasi Pabrik II',
            'kode_mata_kuliah' => 'TK2506',
            'sks' => 3,
            'semester' => 5,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Penyediaan Air Proses & Energi',
            'kode_mata_kuliah' => 'TK2507',
            'sks' => 3,
            'semester' => 5,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Pengolahan Limbah',
            'kode_mata_kuliah' => 'TK2508',
            'sks' => 2,
            'semester' => 5,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktikum Teknik Operasi Pabrik',
            'kode_mata_kuliah' => 'TK2509',
            'sks' => 1,
            'semester' => 5,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktikum Industri Proses Kimia',
            'kode_mata_kuliah' => 'TK2510',
            'sks' => 1,
            'semester' => 5,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Praktek Kerja Lapangan',
            'kode_mata_kuliah' => 'TK2607',
            'sks' => 2,
            'semester' => 6,
            'program_studies_id' => 1,
        ]);
        Mata_Kuliah::create([
            'name_mata_kuliah' => 'Karya Tulis Ilmiah',
            'kode_mata_kuliah' => 'TK2608',
            'sks' => 3,
            'semester' => 6,
            'program_studies_id' => 1,
        ]);
    }
}
