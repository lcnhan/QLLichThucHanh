<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TuanTH extends Model
{
    protected $table = "tuan_th";

    public function tuan_hks(){
    	return $this->belongsTo('App\HocKy','id_hk','id_hk');
    }

    public function tuanyc_tuans(){
    	return $this->hasMany('App\TuanYC','id_tuan','id_tuan');
    }
}
