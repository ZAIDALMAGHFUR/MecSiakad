<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {
        $user = User::create([
            'username' => $row[0],
            'email' => $row[1],
            'password' => bcrypt($row[2]),
            'roles_id' => $row[3],
        ]);

        return new Mahasiswa([
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
                'foto' => $row['foto'],
        ]);
    }
}
