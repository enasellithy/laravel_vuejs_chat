<?php

namespace App\Http\Controllers;

use App\Events\SentMessage;
use Illuminate\Http\Request;
use App\User;
use App\Chat;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat');
    }

    public function getChats()
    {
        return Chat::with('user')->get();
    }

    public function saveUserChat (Request $request)
    {
        $sender_id = $request->user()->id;
        $receiver_id = $request->input('receiver_id');
        $chatText = $request->input('message');
        $data = [
            'sender_id' => $sender_id,
            'receiver_id' => 2,
            'message' => $chatText,
            'read' => 0
        ];
        $chat = Chat::create($data);
        $finalData = Chat::where('id', $chat->id)->first();
        broadcast(new MessageSent($chat->load('user')))->toOthers();
        return response(['data' => $finalData], 201);
    }

    public function store(Request $request)
    {
        dd($request->all());
//        $message = auth()->user()->messages()->create([
//            'message' => $request->message
//        ]);
//        broadcast(new SentMessage($message));
        return ['status' => 'success'];
    }
}
