<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts(){
        return $this->hasMany('Mercury\Post');
    }
}
