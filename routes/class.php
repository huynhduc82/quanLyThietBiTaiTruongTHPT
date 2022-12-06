<?php

use Illuminate\Support\Facades\Route;

Route::get('class-time',['uses' => 'Class\ClassTimeRegulationController@index']);
