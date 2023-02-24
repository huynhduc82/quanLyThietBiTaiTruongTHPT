<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'mail',
], function (){
    Route::get('/',[
        'uses' => 'Mails\MailController@test'
    ]);
});
