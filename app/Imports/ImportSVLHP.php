<?php

namespace App\Imports;

use App\DSSV_LHP;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSVLHP implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DSSV_LHP([
            'mssv' => $row[1],
            'ma_lophp' => $row[0]
        ]);
    }
}
