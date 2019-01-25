<?php

namespace Mercury;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', "API_KEY", "date_of_birth", "image", "city", "phone", "about",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany("Mercury\Post");
    }

    public function comments()
    {
        return $this->hasMany("Mercury\Comment");
    }

    public function followers()
    {
        return $this->hasMany("Mercury\Follower");
    }

    public function reviewToMe()
    {
        return $this->belongsTo("Mercury\Review", 'id', 'user_id');
    }

    public function reviewFromMe()
    {
        return $this->belongsTo("Mercury\Review", 'id', 'from_id');
    }

    public function sent()
    {
        return $this->hasMany('Mercury\Message', 'from_id');
    }

    public function received()
    {
        return $this->hasMany('Mercury\Message', 'user_id');
    }

}
