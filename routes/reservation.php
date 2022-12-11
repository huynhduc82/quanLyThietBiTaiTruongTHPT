<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'reservation',
], function (){
    Route::get('/',[
        'uses' => 'Reservations\EquipmentReservationController@index'
    ]);
    Route::get('/{id}',[
        'uses' => 'Reservations\EquipmentReservationController@details'
    ]);
    Route::post('/', [
        'uses' => 'Reservations\EquipmentReservationController@store'
    ]);
    Route::post('/{id}', [
        'uses' => 'Equipment\EquipmentController@edit'
    ]);
    Route::delete('/{id}', [
        'uses' => 'Equipment\EquipmentController@delete'
    ]);
});
