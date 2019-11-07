<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YeuCau_lth extends Model
{
    protected $table = "yeucau_lth";
    protected $primaryKey = 'id_yeucau';
    
    public function yeucau_lths(){
    	return $this->hasMany('App\ChitietYC','id_yeucau','id_yeucau');
    }
}
