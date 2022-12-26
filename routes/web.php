<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => '/',
], function (){
    Route::get('/', function () {
        return view('dashboard/index');
    })->name('dashboard.index');
});

Route::group([
    'prefix' => '/equipment',
], function (){
    Route::get('/index',[
        'uses' => 'Equipment\TypeOfEquipmentController@indexView'
    ])->name('equipment.index');
    Route::get('/store',[
        'uses' => 'Equipment\TypeOfEquipmentController@storeView'
    ])->name('equipment.store');
    Route::get('/edit/{id}',[
        'uses' => 'Equipment\TypeOfEquipmentController@editView'
    ])->name('equipment.edit');
});

Route::group([
    'prefix' => '/equipment',
], function (){
    Route::get('/store-details/{id}',[
        'uses' => 'Equipment\EquipmentController@storeView'
    ])->name('equipment_details.store');
    Route::get('/edit-details/{id}',[
        'uses' => 'Equipment\EquipmentController@editView'
    ])->name('equipment_details.edit');
});

Route::group([
    'prefix' => '/reservation',
], function (){
    Route::get('/index', function () {
        return view('reservation/index');
    })->name('reservation.index');
});

Route::group([
    'prefix' => '/lend_return',
], function (){
    Route::get('/index',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@indexView'
    ])->name('lend_return.index');
});

Route::group([
    'prefix' => '/maintenance',
], function (){
    Route::get('/index', function () {
        return view('maintenance/index');
    })->name('maintenance.index');
});

Route::group([
    'prefix' => '/liquidation',
], function (){
    Route::get('/index', function () {
        return view('liquidation/index');
    })->name('liquidation.index');
});

Route::group([
    'prefix' => '/class',
], function (){
    Route::get('/time/index', function () {
        return view('classtime/index');
    })->name('class.time.index');
});

Route::group([
    'prefix' => '/number',
], function (){
    Route::get('/index', function () {
        return view('specifythenumberofequipment/index');
    })->name('equipment.number.index');
});

Route::group([
    'prefix' => '/course',
], function (){
    Route::get('/index', function () {
        return view('course/index');
    })->name('course.index');
});

Route::group([
    'prefix' => '/room',
], function (){
    Route::get('/index', function () {
        return view('room/index');
    })->name('room.index');
});

Route::group([
    'prefix' => '/grade',
], function (){
    Route::get('/index', function () {
        return view('grade/index');
    })->name('grade.index');
});

Route::group([
    'prefix' => '/profile',
], function (){
    Route::get('/index', function () {
        return view('profile/index');
    });
});

Route::group([
    'prefix' => '/signin',
], function (){
    Route::get('/index', function () {
        return view('signin/index');
    })->name('signin.index');
});

Route::group([
    'prefix' => '/signup',
], function (){
    Route::get('/index', function () {
        return view('signup/index');
    })->name('signup.index');
});

Route::group([
    'prefix' => 'user',
], function (){
    Route::get('/index',[
        'uses' => 'User\UserProfileController@indexView'
    ])->name('profile.index');
});


Route::group([
    'prefix' => 'register',
], function (){
    Route::get('/index',[
        'uses' => 'Auth\RegisterController@showRegistrationForm'
    ])->name('register');
    Route::post('',[
        'uses' => 'Auth\RegisterController@register'
    ]);
});

Route::group([
    'prefix' => 'login',
], function (){
    Route::get('/index',[
        'uses' => 'Auth\LoginController@showLoginForm'
    ])->name('login');
    Route::post('/index',[
        'uses' => 'Auth\LoginController@login'
    ]);
});

Route::post('logout',[
    'uses' => 'Auth\LoginController@logout'
])->name('logout');



//$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
//$this->get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
//$this->post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
//$this->get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
//$this->get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
//$this->post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
