<?php

use Illuminate\Support\Facades\Route;

Route::get('grade',['uses' => 'Grades\GradeController@index']);
