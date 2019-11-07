<?php

namespace App\Imports;

use App\LopHP;
use App\BuoiTH;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportLHP implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $lhp = new LopHP([
            'ma_mon' => $row[0],
            'ma_lophp' => $row[3],
            'real_ma_lhp' => $row[3],
            'ten_lophp' => $row[4],
            'ma_canbo' => $row[5],
            'so_buoi_th' => $row[6],
            'nien_khoa' => $row[8],
            'ky_hieu' => $row[7]
        ]);
        $lhp->save();

        $buoith = new BuoiTH([
            'ma_lophp' => $row[3],
            'thu' => $row[1],
            'tietbd' => $row[2]
        ]);
        $buoith->save();
    
    }
}
