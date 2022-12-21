<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'number-equipment',
], function (){
    Route::get('/',[
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@index'
    ]);
    Route::get('/{id}',[
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@details'
    ]);
    Route::post('/', [
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@store'
    ]);
    Route::post('/cal-equipment', [
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@calEquipmentQuantity'
    ]);
    Route::delete('/{id}', [
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@delete'
    ]);
});
