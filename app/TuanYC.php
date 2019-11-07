<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TuanYC extends Model
{
    protected $table = "tuan_theo_yc";

    public function tuanyc_cts(){
    	return $this->belongsTo('App\YeuCau','id_chitietyc','id_chitietyc');
    }

    public function tuanyc_tuans(){
    	return $this->belongsTo('App\TuanTH','id_tuan','id_tuan');
    }

    public function tuanyc_dds(){
    	return $this->hasMany('App\Diemdanh','id_tuanyc','id_tuanyc');
    }

    public function tuanyc_Sapxep(){
        return $this->hasMany('App\Sapxep','id_tuanyc','id_tuanyc');
    }
}
