<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YeuCauPM extends Model
{
	protected $table = "yc_pm";

    public function YeuCauPM_chitiet_yc(){
    	return $this->belongsTo('App\ChitietYC','id_chitietyc','id_chitietyc');
    }

    public function YeuCauPM_PhanMem(){
    	return $this->belongsTo('App\PhanMem','id_pm','id_pm');
    }

}
    
