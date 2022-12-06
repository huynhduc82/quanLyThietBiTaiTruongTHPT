<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'reservation',
], function (){
    Route::get('/',[
        'uses' => 'Reservations\EquipmentReservationController@index'
    ]);
    Route::post('/', [
        'uses' => 'Reservations\EquipmentReservationController@store'
    ]);
    Route::post('/{id}', [
        'uses' => 'Equipment\EquipmentController@edit'
    ]);
});
