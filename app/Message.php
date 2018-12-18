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

    public static function saveMessage(Message $msg): boolean
    {
        if ($newMsg->save()) {
            self::notify();
            return true;
        } else return false;
    }

    private static function notify(int $from_id, int $user_id)
    {
        $notification = [
            'event' => 'newChatMessage',
            'data' => [
                'from_id' => $from_id,
                'to_id' => $user_id,
            ],
        ];
        Redis::publish('notification', json_encode($notification));
    }
}
