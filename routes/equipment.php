<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'equip',
], function (){
    Route::get('/',[
        'uses' => 'Equipment\EquipmentController@index'
    ]);
    Route::get('/{id}',[
        'uses' => 'Equipment\EquipmentController@details'
    ]);
    Route::post('/', [
        'uses' => 'Equipment\EquipmentController@store'
    ]);
    Route::post('/{id}', [
        'uses' => 'Equipment\EquipmentController@edit'
    ]);
    Route::delete('/{id}', [
        'uses' => 'Equipment\EquipmentController@delete'
    ]);
});

Route::group([
    'prefix' => 'type/equip',
], function (){
    Route::get('/',[
        'uses' => 'Equipment\TypeOfEquipmentController@index'
    ]);
    Route::get('/{id}',[
        'uses' => 'Equipment\TypeOfEquipmentController@detail'
    ]);
    Route::post('/', [
        'uses' => 'Equipment\TypeOfEquipmentController@store'
    ]);
    Route::post('/{id}', [
        'uses' => 'Equipment\TypeOfEquipmentController@edit'
    ]);
});
