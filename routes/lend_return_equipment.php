<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'lend',
], function (){
    Route::post('/', [
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@lend'
    ]);
    Route::post('/approved/{id}', [
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@approved'
    ]);
});

Route::group([
    'prefix' => 'return',
], function (){
    Route::post('/{id}', [
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@store'
    ]);
});

Route::group([
    'prefix' => 'lend-return',
], function (){
    Route::get('/',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@index'
    ]);
    Route::get('/{id}',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@details'
    ]);
    Route::post('/{id}',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@edit'
    ]);
    Route::delete('/{id}',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@delete'
    ]);
    Route::post('/broken/report/{id}', [
        'uses' => 'Equipment\EquipmentController@brokenReport'
    ])->name('equipment_details.delete');
});
