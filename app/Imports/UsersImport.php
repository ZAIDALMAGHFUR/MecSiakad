<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $rows)
    {
        
    }
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach($rows as $key=>$row){
            if($key === 0){
                continue;
            }
            // dd($row[2]);
            

            $user = User::create([
                'username' => $row[0],
                'email' => $row[2],
                'password' => bcrypt($row[7]),
                'roles_id' => 3,
            ]);
            
            Mahasiswa::create([
                    'name' => $row[0],
                    'nim' => $row[1],
                    'email' => $row[2],
                    'no_hp' => $row[3],
                    'alamat' => $row[4],
                    'program_studies_id' => $row[5],
                    'tempat_lahir' => $row[6],
                    'tanggal_lahir' => $row[7],
                    'jenis_kelamin' => $row[8],
                    'agama' => $row[9],
                    'status' => $row[10],
                    'user_id' => $user->id,
                    'foto' => $row[12] ?? '',
            ]);
        }

    }
}
