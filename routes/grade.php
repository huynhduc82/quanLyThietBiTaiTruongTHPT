<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'grade',
], function () {
    Route::get('/', [
        'uses' => 'Grades\GradeController@index'
    ]);
    Route::get('/{id}', [
        'uses' => 'Grades\GradeController@details'
    ]);
    Route::post('/', [
        'uses' => 'Grades\GradeController@store'
    ]);
     Route::post('/{id}', [
        'uses' => 'Grades\GradeController@edit'
    ]);
    Route::post('/import', [
        'uses' => 'Grades\GradeController@importCourseDetail'
    ]);
    Route::delete('/{id}', [
        'uses' => 'Grades\GradeController@delete'
    ]);
});
