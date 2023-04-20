<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DosenImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function rules(): array
    {
        return [
            'nim' => function($attribute, $value, $onFailure) {
                if(Dosen::where('nidn', '=', $value)->exists()){
                    $onFailure("NIDN $value sudah ada");
                    // dd($value);
                }
            }, 
            'email' => function($attribute, $value, $onFailure) {
                if(User::where('email', $value)->exists()){
                    $onFailure("Email $value sudah ada");
                }
            },
            'kode_dosen' => 'required',
            'nama_dosen'=> 'required',
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
            'username' => $row['nama_dosen'],
            'email' => $row['email'],
            'password' => bcrypt($row['nidn']),
            'roles_id' => 2,
        ]);
        
        return new Dosen([
            'kode_dosen' => $row['kode_dosen'],
            'nama_dosen' => $row['nama_dosen'],
            'nidn' => $row['nidn'],
            'email' => $row['email'],
            'no_hp' => $row['no_hp'],
            'alamat' => $row['alamat'],
            'program_studies_id' => $row['program_studies_id'],
            'pendidikan_terakhir' => $row['pendidikan_terakhir'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'agama' => $row['agama'],
            'status' => $row['status'],
            'users_id' => $user->id,
        ]);
    }
}
