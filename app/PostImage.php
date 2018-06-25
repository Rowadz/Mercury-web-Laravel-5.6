<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $fillable = [
      'post_id', 'location'
    ];
    public function post(){
        return $this->belongsTo("Mercury\\Post");
    }
}
