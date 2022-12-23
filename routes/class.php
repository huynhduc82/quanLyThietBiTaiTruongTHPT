<?php

use Illuminate\Support\Facades\Route;

Route::get('class-time',['uses' => 'Class\ClassTimeRegulationController@index']);

Route::group([
    'prefix' => 'class',
], function (){
    Route::get('/',[
        'uses' => 'Class\ClassController@index'
    ]);
    Route::get('/{id}',[
        'uses' => 'Class\ClassController@details'
    ]);
    Route::post('/', [
        'uses' => 'Class\ClassController@store'
    ]);
    Route::post('/{id}', [
        'uses' => 'Class\ClassController@edit'
    ]);
    Route::post('/import-class', [
        'uses' => 'Class\ClassController@importClass'
    ]);
    Route::delete('/{id}', [
        'uses' => 'Class\ClassController@delete'
    ]);
});
