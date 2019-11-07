<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monhoc extends Model
{
    protected $table = "mon_hoc";
    protected $fillable = ['ma_mon','ten_mon','tin_chi','so_tiet_lt','so_tiet_th'];

    public function lhps(){
    	return $this->hasMany('App\LopHP','id_monhoc','id_monhoc');
    }
}
