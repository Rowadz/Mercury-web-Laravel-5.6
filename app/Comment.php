<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post(){
        return $this->belongsTo("Mercury\\Post");
    }

    public function user(){
        return $this->belongsTo("Mercury\\User");
    }
}
