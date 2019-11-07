<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LopHP extends Model
{
    protected $table = "lop_hp";
    protected $fillable = ['ma_lophp', 'real_ma_lhp', 'ma_canbo', 'ma_mon', 'ten_lophp','so_buoi_th', 'ky_hieu', 'nien_khoa'];

    public function buoiths(){
    	return $this->hasMany('App\BuoiTH','ma_lophp','ma_lophp');
    }

    public function monhocs(){
        return $this->belongsTo('App\Monhoc','ma_mon','ma_mon');
    }

    public function canbos(){
        return $this->belongsTo('App\Canbo','ma_canbo','ma_canbo');
    }

    public function hks(){
        return $this->belongsTo('App\HocKy','id_hk','id_hk');
    }

    public function lhps_sinhvien(){
        return $this->hasMany('App\DSSV_LHP','ma_lophp','ma_lophp');
    }

    public function lhpss(){
        return $this->hasMany('App\YeuCau','ma_lophp','ma_lophp');
    }
}
