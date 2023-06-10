<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithValidation

{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    private $importedRows = 0;

    public function getImportedRowCount()
    {
        return $this->importedRows;
    }


    public function rules(): array
    {
        return [
            'nim' => function($attribute, $value, $onFailure) {
                if(Mahasiswa::where('nim', '=', $value)->exists()){
                    $onFailure("NIM $value sudah ada");
                    // dd($value);
                }
            },
            'email' => function($attribute, $value, $onFailure) {
                if(User::where('email', $value)->exists()){
                    $onFailure("Email $value sudah ada");
                }
            },
            'name'=> 'required',
            'no_hp'=> 'required',
            'alamat'=> 'required',
            'program_studies_id'=> 'required',
            'tempat_lahir'=> 'required',
            'tanggal_lahir'=> 'required',
            'jenis_kelamin'=> 'required',
            'agama'=> 'required',
            'status'=> 'required',
        ];
    }

    public function model (array $row)
    {
        // dd($row);
        $user = User::create([
            'username' => $row['name'],
            'email' => $row['email'],
            'password' => bcrypt($row['nim']),
            'roles_id' => 3,
        ]);

        Mahasiswa::create([
                'name' => $row['name'],
                'nim' => $row['nim'],
                'email' => $row['email'],
                'no_hp' => $row['no_hp'],
                'alamat' => $row['alamat'],
                'program_studies_id' => $row['program_studies_id'],
                'tempat_lahir' => $row['tempat_lahir'],
                'tanggal_lahir' => $row['tanggal_lahir'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'agama' => $row['agama'],
                'status' => $row['status'],
                'user_id' => $user->id,
                'foto' => $row['foto'] ?? '',
                'tahun_masuk' => $row['tahun_masuk'],
                'nama_ayah' => $row['nama_ayah'],
                'nama_ibu' => $row['nama_ibu'],
                'pekerjaan_ayah' => $row['pekerjaan_ayah'],
                'pekerjaan_ibu' => $row['pekerjaan_ibu'],
                'no_hp_ortu' => $row['no_hp_ortu'],
                'alamat_ortu' => $row['alamat_ortu'],
                'asal_sekolah' => $row['asal_sekolah'],
                'tahun_academics_id' => $row['tahun_academics_id'],
        ]);


        $this->importedRows++;

    }
}
