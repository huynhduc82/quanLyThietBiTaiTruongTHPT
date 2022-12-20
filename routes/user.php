<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'user',
], function (){
    Route::get('/',[
        'uses' => 'User\UserProfileController@index'
    ]);
    Route::get('/{id}',[
        'uses' => 'User\UserProfileController@details'
    ]);
    Route::post('/add-course', [
        'uses' => 'User\UserProfileController@addCourse'
    ]);
    Route::post('/{id}', [
        'uses' => 'Equipment\EquipmentController@edit'
    ]);
    Route::put('/edit-profile/{id}', [
        'uses' => 'User\UserProfileController@edit'
    ]);
    Route::delete('/{id}', [
        'uses' => 'Equipment\EquipmentController@delete'
    ]);
});
