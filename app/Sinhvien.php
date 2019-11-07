<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinhvien extends Model
{
    protected $table = "sinh_vien";
    protected $fillable = ['id_account','mssv','khoa_hoc','ma_lop','ten_sv','ngay_sinh','gioi_tinh','sdt','nam_vao_hoc'];

    public function sinhviens(){
    	return $this->belongsTo('App\User','id_account','id');
    }

    public function sinhvien_lhps(){
    	return $this->hasMany('App\DSSV_LHP','mssv','mssv');
    }
}
