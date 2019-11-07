<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YeuCau extends Model
{
    protected $table = "chitiet_yc";

    public function YeuCau_canbos(){
    	return $this->belongsTo('App\Canbo','ma_canbo','ma_canbo');
    }

    public function yeucau_lths(){
    	return $this->belongsTo('App\YeuCau_lth','id_yeucau','id_yeucau');
    }

    public function lhpss(){
    	return $this->belongsTo('App\LopHP','ma_lophp','ma_lophp');
    }

    public function chitietyc_YcPM(){
        return $this->hasMany('App\YeuCauPM','id_chitietyc','id_chitietyc');
    }

    public function chitiet_yc_TuanYC(){
        return $this->hasMany('App\TuanYC','id_chitietyc','id_chitietyc');
    }
}
