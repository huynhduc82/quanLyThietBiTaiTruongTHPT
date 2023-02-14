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
    Route::get('/by-name/{name}/{id}',[
        'uses' => 'Equipment\EquipmentController@getByName'
    ]);
    Route::get('/by-room-id/{id}',[
        'uses' => 'Equipment\EquipmentController@getByRoomId'
    ]);
    Route::get('/by-id/{id}',[
        'uses' => 'Equipment\EquipmentController@getById'
    ]);
    Route::post('/', [
        'uses' => 'Equipment\EquipmentController@store'
    ]);
    Route::post('/{id}', [
        'uses' => 'Equipment\EquipmentController@edit'
    ]);
    Route::delete('/{id}', [
        'uses' => 'Equipment\EquipmentController@delete'
    ])->name('equipment_details.delete');
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
    Route::delete('/delete/{id}', [
        'uses' => 'Equipment\TypeOfEquipmentController@delete'
    ])->name('equipment.delete');
    Route::post('/import/equipment', [
        'uses' => 'Equipment\TypeOfEquipmentController@importEquipment'
    ])->name('equipment.import.excel');
    Route::get('/update/all/quantity', [
        'uses' => 'Equipment\TypeOfEquipmentController@updateAllQuantity'
    ]);
});
