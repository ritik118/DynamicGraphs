<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id','ques_id','option_id'];

    public function questionings()
    {
        return $this->belongsTo('App\Questioning','ques_id');
    }
}
