<?php

use App\Events\SendLocation;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('map', function (Request $request){
    $lat = $request->input('lat');
    $long = $request->input('long');
    $location = ["lat" => $lat, "long" => $long];
    event(new SendLocation($location));
    return response()->json(['status'=>'success','data'=>$location]);
});

Route::namespace('API')->group(function (){
    Route::get('chat','ChatController@index');
    Route::post('sendchat','ChatController@saveUserChat');
});
