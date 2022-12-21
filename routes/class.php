<?php

use Illuminate\Support\Facades\Route;

Route::get('class-time',['uses' => 'Class\ClassTimeRegulationController@index']);

Route::group([
    'prefix' => 'class',
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
    Route::post('/import-class', [
        'uses' => 'Class\ClassController@importClass'
    ]);
    Route::delete('/{id}', [
        'uses' => 'Equipment\EquipmentController@delete'
    ]);
});
