<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notfy()
    {
        $tokens=null;
        $notification=null;
        define( 'API_ACCESS_KEY', 'AAAAo7q61_0:APA91bFZZ1jFlEOQoBurCBxO8xN894XJB0h30N8pIzW8vu7o4da_5C7flVkZGYXu1asZKTWDJlEXpymf13TkIkGwEb77yFCes7OPUoYnCcztAvfij2rxNZx1kX9XePcYNu_3uXNlCGdZ' );
        #prep the bundle
        $msg = array
        (
            'body'              => 'body',
            'title'             => 'Title',
            'action'            => 'Action',
            'notification_id'   => $notification != NULL ? $notification : 0,
            'vibrate'   => 1,
            'sound' => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon'
        );
        $fields = array
        (
            'registration_ids' => $tokens,
            //'to' => 'fertrr5AzuA:APA91bEr8m5T4aezVfiABDAoaRKZSFoNTODOlM3u7irYj2ZroIwRPIYu2RsPMLimTCSo7WyUUxoKx0q8jiDJdnL_AMZSk_WT-fA8hg0TgngO5bJQkmQ3N4mkHxLGKneEX_DWh-exmwRe',
            'notification'  => $msg,
            'data'  => $msg
        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        #Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        //return $result;
        if($result){
            dd($msg);
        }else{
            return 'error';
        }
    }
}
