<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nganh extends Model
{
    protected $table = "nganh";

    public function lops(){
    	return $this->hasMany('App\Lop','ma_nganh','ma_nganh');
    }

    // public function province(){
    //     return $this->belongsTo('App\Province','id_province','id_province');
    // }
}
