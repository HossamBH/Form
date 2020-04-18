<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
     protected $fillable = array('name', 'image', 'age', 'type');
}
