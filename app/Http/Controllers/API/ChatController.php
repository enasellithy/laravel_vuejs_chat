<?php

namespace App\Http\Controllers\API;

use App\Chat;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with('user')->get();
        return response()->json($chats);
    }

    public function saveUserChat(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'message' => 'required',
            'sender_id' => 'required',
            'receiver_id' => 'required'
        ]);
        $arr = [];
        foreach ($validator->errors()->messages() as $key => $err) {
            array_push($arr, (object) [$key => $err[0]] );
        }
        $new['message']  = $arr;
        if($validator->fails()){
            return response()->json($new, 422);
        } else {
           $chats = Chat::create([
                'message' => $request->message,
                'sender_id'=> $request->sender_id,
                'receiver_id' => $request->receiver_id
            ]);
           return response()->json(['data' => $chats],200);
        }
    }
}
