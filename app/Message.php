<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

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

    public static function saveMessage(Message $msg, int $userToNotify)
    {
        if ($msg->save()) {
            self::notify($userToNotify);
            return true;
        } else {
            return false;
        }

    }

    private static function notify($userToNotify)
    {
        $notification = [
            'event' => 'newMessage',
            'data' => [
                'username' => Auth()->user()->name,
                'userId' => $userToNotify,
            ],
        ];
        Redis::publish('notification', json_encode($notification));
    }
}
