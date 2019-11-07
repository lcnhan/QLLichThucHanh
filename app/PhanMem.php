<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhanMem extends Model
{
    protected $table = "phan_mem";

    public function pm_phongs(){
    	return $this->hasMany('App\PM_of_Phong','id_pm','id_pm');
    }

    public function PhanMem_YcPM(){
        return $this->hasMany('App\YeuCauPM','id_pm','id_pm');
    }
    
}
