<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    protected $table = "lop";

    public function nganhs(){
    	return $this->belongsTo('App\Nganh','ma_nganh','ma_nganh');
    }

    // public function province(){
    //     return $this->belongsTo('App\Province','id_province','id_province');
    // }
}
