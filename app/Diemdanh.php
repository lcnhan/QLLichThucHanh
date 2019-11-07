<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diemdanh extends Model
{
    protected $table = "diem_danh";
    protected $primaryKey = 'id_dd';

    public function dd_svlhps(){
    	return $this->belongsTo('App\DSSV_LHP','id_sv_lhp','id_sv_lhp');
    }

    public function dd_tuans(){
    	return $this->belongsTo('App\TuanYC','id_tuanyc','id_tuanyc');
    }
}
