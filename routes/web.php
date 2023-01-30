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
    Route::get('/index',[
        'uses' => 'Reservations\EquipmentReservationController@indexView'
    ])->name('reservation.index')->middleware('auth');
    Route::get('/store',[
        'uses' => 'Reservations\EquipmentReservationController@storeView'
    ])->name('reservation.store')->middleware('auth');
    Route::get('/filter',[
        'uses' => 'Reservations\EquipmentReservationController@filter'
    ])->name('reservation.filter')->middleware('auth');
    Route::post('/',[
        'uses' => 'Reservations\EquipmentReservationController@store'
    ])->middleware('auth');
    Route::post('/approved/{id}',[
        'uses' => 'Reservations\EquipmentReservationController@approved'
    ])->name('reservation.approved')->middleware('auth');
    Route::post('/cancel/{id}',[
        'uses' => 'Reservations\EquipmentReservationController@cancel'
    ])->name('reservation.cancel')->middleware('auth');
    Route::delete('/delete/{id}',[
        'uses' => 'Reservations\EquipmentReservationController@delete'
    ])->name('reservation.delete')->middleware('auth');
    Route::post('/lend/{id}',[
        'uses' => 'Reservations\EquipmentReservationController@lend'
    ])->name('reservation.lend')->middleware('auth');
});

Route::group([
    'prefix' => '/lend_return',
], function (){
    Route::get('/index',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@indexView'
    ])->name('lend_return.index');
    Route::get('/store',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@storeView'
    ])->name('lend_return.store');
    Route::get('/by/day',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@getLendReturnByDay'
    ]);
    Route::get('/return/view/{id}',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@returnView'
    ])->name('lend_return.returnView');
    Route::post('/return/{id}',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@return'
    ])->name('lend_return.return');
    Route::post('/', [
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@lend'
    ]);
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
    Route::get('/time/index', [
        'uses' => 'Class\ClassTimeRegulationController@indexView'
    ])->name('class.time.index');
    Route::get('/time/store', [
        'uses' => 'Class\ClassTimeRegulationController@storeView'
    ])->name('class.time.store');
    Route::get('/time/edit', [
        'uses' => 'Class\ClassTimeRegulationController@editView'
    ])->name('class.time.edit');
});

Route::group([
    'prefix' => '/number',
], function (){
    Route::get('/index',[
        'uses' => 'SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsController@indexView'
    ])->name('equipment.number.index');
    Route::get('/store', function () {
        return view('specifythenumberofequipment/store');
    })->name('equipment.number.store');
    Route::get('/edit', function () {
        return view('specifythenumberofequipment/edit');
    })->name('equipment.number.edit');
});

Route::group([
    'prefix' => '/course',
], function (){
    Route::get('/index', [
     'uses' => 'Course\CourseController@indexView'
    ])->name('course.index');
    Route::get('/store', [
        'uses' => 'Course\CourseController@storeView'
    ])->name('course.store');
    Route::get('/edit', [
        'uses' => 'Course\CourseController@editView'
    ])->name('course.edit');
});

Route::group([
    'prefix' => '/room',
], function (){
    Route::get('/index', [
        'uses' => 'Rooms\RoomController@indexView'
    ])->name('room.index');
    Route::get('/store', [
        'uses' => 'Rooms\RoomController@storeView'
    ])->name('room.store');
    Route::get('/edit', [
        'uses' => 'Rooms\RoomController@editView'
    ])->name('room.edit');
});

Route::group([
    'prefix' => '/grade',
], function (){
    Route::get('/index', [
        'uses' => 'Grades\GradeController@indexView'
    ])->name('grade.index');
    Route::get('/store', [
        'uses' => 'Grades\GradeController@storeView'
    ])->name('grade.store');
    Route::get('/edit', [
        'uses' => 'Grades\GradeController@editView'
    ])->name('grade.edit');
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
