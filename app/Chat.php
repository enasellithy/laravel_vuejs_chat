<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['message', 'sender_id', 'receiver_id'];

//    protected $appends = ['sender', 'receiver'];

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recive(){
        $this->belongsTo(User::class,'receiver_id');
    }
}
