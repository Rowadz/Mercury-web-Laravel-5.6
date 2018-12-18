<?php

namespace Mercury\Http\Controllers;

use Mercury\Message;
use Mercury\User;
use Mercury\users_names_for_chat;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['searchPage']);
    }

    public function index()
    {
        $data = [
            'users' => users_names_for_chat::select('sender_name as name', 'sender_image as image')->where(function ($q) {
                $q->where('sender_id', Auth()->user()->id)->orWhere('revicer_id', Auth()->user()->id);
            })->where('sender_id', '!=', Auth()->user()->id)->get(),
        ];
        return view('user.chat.chat')->with($data);
    }

    public function getMessages(string $name)
    {
        $user = User::where('name', $name)->first();
        $data = [
            'messages' => Message::where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('from_id', $user->id);
            })->where(function ($q) use ($user) {
                $q->where('user_id', Auth()->user()->id)
                    ->orWhere('from_id', Auth()->user()->id);
            })->get(),
        ];

        return response()->json($data);
    }

    public function saveMessage(Request $request)
    {
        $newMsg = new Message;
        $newMsg->from_id = $request->from_id;
        $newMsg->user_id = $request->user_id;
        $newMsg->body = $request->body;
        return Message::saveMessage($newMsg) ?
        response()->json(['message' => 'success']) :
        response()->json(['message' => 'faild']);
    }
}
