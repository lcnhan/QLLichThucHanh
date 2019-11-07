<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuoiTH extends Model
{
    protected $table = "buoi_th";
    protected $fillable = ['ma_lophp','thu','tietbd'];

    public function lhps(){
        return $this->belongsTo('App\LopHP','ma_lophp','ma_lophp');
    }
}
