<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canbo extends Model
{
    protected $table = "can_bo";
    protected $fillable = ['id_account','ma_canbo','ten_cb','ngay_sinh','gioi_tinh','sdt','ngay_vao_lam'];

    public function canbos(){
    	return $this->belongsTo('App\User','id_account','id');
    }

    public function lhps(){
    	return $this->hasMany('App\LopHP','ma_canbo','ma_canbo');
    }

    public function Canbo_YeuCau(){
        return $this->hasMany('App\YeuCau','ma_canbo','ma_canbo');
    }

    // public function province(){
    //     return $this->belongsTo('App\Province','id_province','id_province');
    // }
}
