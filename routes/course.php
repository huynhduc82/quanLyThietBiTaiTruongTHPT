<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'course',
], function (){
    Route::get('/',[
        'uses' => 'Course\CourseController@index'
    ]);
    Route::get('/{id}',[
        'uses' => 'Course\CourseController@details'
    ]);
    Route::post('/', [
        'uses' => 'Course\CourseController@store'
    ]);
    Route::post('/{id}', [
        'uses' => 'Course\CourseController@edit'
    ]);
    Route::delete('/{id}', [
        'uses' => 'Course\CourseController@delete'
    ]);
});

Route::group([
    'prefix' => 'course-details',
], function (){
    Route::get('/',[
        'uses' => 'Course\CourseDetailController@index'
    ]);
    Route::get('/{id}',[
        'uses' => 'Course\CourseDetailController@details'
    ]);
    Route::post('/', [
        'uses' => 'Course\CourseDetailController@store'
    ]);
    Route::put('/{id}', [
        'uses' => 'Course\CourseDetailController@edit'
    ]);
    Route::post('/import', [
        'uses' => 'Course\CourseDetailController@importCourseDetail'
    ]);
    Route::delete('/{id}', [
        'uses' => 'Course\CourseDetailController@delete'
    ]);
});
