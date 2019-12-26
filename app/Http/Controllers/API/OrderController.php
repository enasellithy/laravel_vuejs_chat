<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Order;
use App\Notifications;

class OrderController extends Controller
{
    public function clientOrder()
    {
        $validator = Validator::make(request()->all(), [
            'watertype_id' => 'required',
            'quantity_id' => 'required',
            'driver_id' => 'required',
            'lat' => 'required',
            'lang' => 'required',
            'address' => 'required',
        ]);
        $arr = [];
        foreach ($validator->errors()->messages() as $key => $err) {
            array_push($arr, (object) [$key => $err[0]] );
        }
        $new['message']  = $arr;
        if($validator->fails()){
            return response()->json($new, 422);
        } else {
            $orders = Order::create(request()->all());
            $nots = Notifications::create([
                'user_id' => $orders->driver_id,
                'title' => $orders->quantity_id,
            ]);
            return response()->json([
                'orders' => $orders,
                'nots' => $nots
            ],200);
        }
    }

    public function driverCancel($id)
    {
        $orders = Order::find($id);
        $orders->status = 'cancel';
        $orders->save();
        $nots = Notifications::create([
            'user_id' => $orders->user_id,
            'title' => 'cancel',
        ]);
        return response()->json(['nots' => $nots],200);
    }

    public function driveraccept($id)
    {
        $orders = Order::find($id);
        $orders->status = 'accept';
        $orders->save();
        $nots = Notifications::create([
            'user_id' => $orders->user_id,
            'title' => 'accept',
        ]);
        return response()->json(['nots' => $nots],200);
    }
}
