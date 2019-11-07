<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sapxep extends Model
{
    protected $table = "sap_xep";

    public function Sapxep_phong(){
    	return $this->belongsTo('App\Phong','id_phong','id_phong');
    }

    public function Sapxep_tuan_theo_yc(){
    	return $this->belongsTo('App\TuanYC','id_tuanyc','id_tuanyc');
    }
}
