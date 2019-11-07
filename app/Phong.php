<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    protected $table = "phong";

    public function phong_pms(){
    	return $this->hasMany('App\PM_of_Phong','id_phong','id_phong');
    }
    public function phong_Sapxep(){
    	return $this->hasMany('App\Sapxep','id_phong','id_phong');
    }
}
