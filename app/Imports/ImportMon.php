<?php

namespace App\Imports;

use App\Monhoc;
use Maatwebsite\Excel\Concerns\ToModel;


class ImportMon implements ToModel
{
    /**
    * @param array $row
    *
    * @return Monhoc|null
    */
    
    public function model(array $row)
    {
       $mon = new Monhoc([
        'ma_mon' => $row[0],
        'ten_mon' => $row[1],
        'tin_chi' => $row[2],
        'so_tiet_lt' => $row[3],
        'so_tiet_th' => $row[4]
       ]);

       $mon->save();
        
    }
}
