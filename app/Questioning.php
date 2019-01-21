<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questioning extends Model
{
	public $timestamps = false;
   protected $fillable = ['label','name'];

    public function options()
    {
        return $this->hasMany('App\Option','ques_id');
    }
    public function answers()
    {
        return $this->hasMany('App\Answer','option_id');
    }
}
