<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
	protected $fillable = array('name');
	
    public function contents()
    {
        return $this->hasMany('App\Content');
    }
}
