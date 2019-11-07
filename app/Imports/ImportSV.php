<?php

namespace App\Imports;

use App\Sinhvien;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class ImportSV implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $usr = new User([
            'name' => $row[2],
            'email' => $row[1],
            'password' => Hash::make($row[4]),
            'role' => "Student"
           ]);
        $usr->save();
        $saveID = $usr->id;

        $sv = new Sinhvien([
            'id_account' => $saveID,
            'mssv' => $row[0],
            'ten_sv' => $row[2],
            'khoa_hoc' => $row[3],
            'ngay_sinh' => $row[5],
            'gioi_tinh' => $row[6],
            'sdt' => $row[7],
            'nam_vao_hoc' => $row[8],
            'ma_lop' => $row[9]
        ]);
        
        $sv->save();
    }
}
