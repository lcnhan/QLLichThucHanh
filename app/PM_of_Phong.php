<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PM_of_Phong extends Model
{
    protected $table = "pm_thuoc_phong";

    public function pms(){
        return $this->belongsTo('App\PhanMem','id_pm','id_pm');
    }

    public function phongs(){
        return $this->belongsTo('App\Phong','id_phong','id_phong');
    }
}
