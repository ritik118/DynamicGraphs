<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questioning extends Model
{
    public $timestamps = false;
    protected $fillable = ['label','name'];
     public function comments()
    {
        return $this->hasOne('App\Comment','ques_id');
    }
	

    public function options()
    {
        return $this->hasMany('App\Option','ques_id');
    }
    public function answers()
    {
        return $this->hasManyThrough('App\Answer','App\Option','ques_id','option_id','id','id');
    }
   
}
