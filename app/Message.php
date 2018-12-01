<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sender() 
    {
        return $this->belongsTo('Mercury\User', 'from_id');
    }

    public function receiver()
    {
        return $this->belongsTo('Mercury\User', 'user_id');
    }
}
