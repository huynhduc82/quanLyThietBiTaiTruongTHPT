<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'lend',
], function (){
    Route::get('/',[
        'uses' => 'LendReturnEquipment\LendEquipmentController@index'
    ]);
    Route::post('/', [
        'uses' => 'LendReturnEquipment\LendEquipmentController@store'
    ]);
    Route::post('/approved/{id}', [
        'uses' => 'LendReturnEquipment\LendEquipmentController@approved'
    ]);
});

Route::group([
    'prefix' => 'return',
], function (){
    Route::get('/',[
        'uses' => 'Equipment\TypeOfEquipmentController@index'
    ]);
    Route::get('/{id}',[
        'uses' => 'Equipment\TypeOfEquipmentController@detail'
    ]);
    Route::post('/', [
        'uses' => 'LendReturnEquipment\ReturnEquipmentController@store'
    ]);
    Route::post('/{id}', [
        'uses' => 'LendReturnEquipment\ReturnEquipmentController@store'
    ]);
});
