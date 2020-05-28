<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhimQuocGia extends Model
{
    protected $guarded=[];
    
    public function phim(){
    	return $this->belongsTo('App\Phim','phim_id','id');
    }
    public function quocGia(){
    	return $this->belongsTo('App\QuocGia','quocgia_id','id');
    }
}
