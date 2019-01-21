<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;
    protected $fillable = ['label','value','ques_id'];
     public function questionings()
    {
        return $this->belongsTo('App\Questioning','ques_id');
    }
}
