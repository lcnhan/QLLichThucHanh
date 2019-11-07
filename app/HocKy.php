<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HocKy extends Model
{
    protected $table = "hoc_ky";

    public function lhps(){
    	return $this->hasMany('App\LopHP','id_hk','id_hk');
    }

    public function tuans(){
    	return $this->hasMany('App\TuanTH','id_hk','id_hk');
    }
}
