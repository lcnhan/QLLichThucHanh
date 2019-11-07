<?php

namespace App\Imports;

use App\Canbo;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class ImportCB implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $usr = new User([
            'name' => $row[1],
            'email' => $row[2],
            'password' => Hash::make($row[3]),
            'role' => $row[4]
           ]);
        $usr->save();
        $saveID = $usr->id;

        $canbo = new Canbo([
            'id_account' => $saveID,
            'ma_canbo' => $row[0],
            'ten_cb' => $row[1],
            'ngay_sinh' => $row[5],
            'gioi_tinh' => $row[6],
            'sdt' => $row[7],
            'ngay_vao_lam' => $row[8]
        ]);
        
        $canbo->save();
    }
}
