<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	public $timestamps = false;
    protected $fillable = ['ques_id','comment'];

    	public function questionings()
    {
        return $this->belongsTo('App\Questioning');
    }
}
