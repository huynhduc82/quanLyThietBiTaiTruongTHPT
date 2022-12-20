<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'course',
], function (){
    Route::get('/',[
        'uses' => 'Course\CourseController@index'
    ]);
    Route::get('/{id}',[
        'uses' => 'Equipment\EquipmentController@details'
    ]);
    Route::post('/', [
        'uses' => 'Equipment\EquipmentController@store'
    ]);
    Route::post('/import-course-details', [
        'uses' => 'Course\CourseController@importCourseDetail'
    ]);
    Route::delete('/{id}', [
        'uses' => 'Equipment\EquipmentController@delete'
    ]);
});
