<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'lend',
], function (){
    Route::get('/',[
        'uses' => 'Equipment\EquipmentController@index'
    ]);
    Route::post('/', [
        'uses' => 'LendReturnEquipment\LendEquipmentController@store'
    ]);
    Route::post('/{id}', [
        'uses' => 'Equipment\EquipmentController@edit'
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
