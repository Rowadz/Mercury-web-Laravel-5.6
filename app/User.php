<?php

namespace Mercury;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', "API_KEY", "date_of_birth", "image" , "city" , "phone", "about"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'API_KEY'
    ];

    public function posts(){
        return $this->hasMany("Mercury\\Post");
    }

    public function comments(){
        return $this->hasMany("Mercury\\Comment");
    }

    public function followers(){
        return $this->hasMany("Mercury\\Follower");
    }
    
}
