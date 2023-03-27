<?php

namespace App\Imports;

use App\Models\User;
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
        ]);
    }


    // public function collection(Collection $rows)
    // {
    //     // dd($rows);
    //     foreach($rows as $key=>$row){
    //         if($key === 0){
    //             continue;
    //         }
    //         // dd($row[2]);
            

    //         $user = User::create([
    //             'username' => $row[0],
    //             'email' => $row[2],
    //             'password' => bcrypt($row[7]),
    //             'roles_id' => 3,
    //         ]);
            
    //         Mahasiswa::create([
    //                 'name' => $row[0],
    //                 'nim' => $row[1],
    //                 'email' => $row[2],
    //                 'no_hp' => $row[3],
    //                 'alamat' => $row[4],
    //                 'program_studies_id' => $row[5],
    //                 'tempat_lahir' => $row[6],
    //                 'tanggal_lahir' => $row[7],
    //                 'jenis_kelamin' => $row[8],
    //                 'agama' => $row[9],
    //                 'status' => $row[10],
    //                 'user_id' => $user->id,
    //                 'foto' => $row[12] ?? '',
    //         ]);
    //     }
    // }
}