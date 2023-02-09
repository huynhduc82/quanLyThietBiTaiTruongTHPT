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
    Route::get('/by-course-details-id/{id}',[
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@getByCourseDetailId'
    ])->name('number.get.by.course.detail.id');
    Route::get('/by-course-id/{id}',[
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@getByCourseId'
    ])->name('number.get.by.course.id');
    Route::get('/by-name/{name}',[
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@getByName'
    ])->name('number.get.by.name');
    Route::post('/', [
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@store'
    ]);
    Route::put('/{id}', [
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@edit'
    ]);
    Route::post('/cal-equipment', [
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@calEquipmentQuantity'
    ]);
    Route::post('/import', [
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@importCourseDetail'
    ]);
    Route::delete('/{id}', [
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@delete'
    ]);
});
