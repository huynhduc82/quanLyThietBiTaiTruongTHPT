<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'room',
], function (){
    Route::get('/',[
        'uses' => 'Rooms\RoomController@index'
    ]);
    Route::post('/', [
        'uses' => 'Rooms\RoomController@store'
    ]);
    Route::post('/{id}', [
        'uses' => 'Rooms\RoomController@edit'
    ]);
});
