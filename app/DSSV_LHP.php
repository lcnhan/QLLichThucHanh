<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DSSV_LHP extends Model
{
    protected $table = "sv_hoc_lhp";
    protected $fillable = ['mssv','ma_lophp'];

    public function svs(){
    	return $this->belongsTo('App\Sinhvien','mssv','mssv');
    }

    public function lhpss(){
    	return $this->belongsTo('App\LopHP','ma_lophp','ma_lophp');
    }

    public function dd_dssvs(){
    	return $this->hasMany('App\Diemdanh','id_sv_lhp','id_sv_lhp');
    }
}
