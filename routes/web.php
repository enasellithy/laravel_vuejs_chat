<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Events\WebsocketDemoEvent;

Route::get('/', function () {
    broadcast(new WebsocketDemoEvent('some date'));
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('chat','MessageController@index');
Route::get('getChats','MessageController@getChats');
Route::post('sendchat','MessageController@saveUserChat');

Route::get('notfy','NotificationController@notfy');
