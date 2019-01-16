<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Mercury\Message;
use Mercury\User;
use Mercury\users_names_for_chat;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['searchPage']);
    }

    public function getNames()
    {
        return response()->json(
            users_names_for_chat::select('sender_name as name', 'sender_image as image')->where(function ($q) {
                $q->where('sender_id', Auth()->user()->id)->orWhere('revicer_id', Auth()->user()->id);
            })->where('sender_id', '!=', Auth()->user()->id)->paginate(10)
        );
    }

    public function getMessages(string $name)
    {
        $user = User::where('name', $name)->first();
        return response()->json(
            Message::where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('from_id', $user->id);
            })->where(function ($q) use ($user) {
                $q->where('user_id', Auth()->user()->id)
                    ->orWhere('from_id', Auth()->user()->id);
            })->orderBy('id', 'desc')->paginate(10)
        );
    }

    public function addMessage(Request $request)
    {
        $user = User::where('name', $request->username)->first();
        $newMsg = new Message;
        $newMsg->from_id = Auth()->user()->id;
        $newMsg->user_id = $user->id;
        $newMsg->body = $request->body;
        return Message::saveMessage($newMsg, $user->id) ?
        response()->json($newMsg) :
        response()->json(['message' => 'faild']);
    }
}
