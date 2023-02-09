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
    'prefix' => '/dashboard',
], function (){
    Route::get('',[
        'uses' => 'Dashboard\DashboardController@indexView'
    ])->name('dashboard.index');
    Route::get('/static/{start}/{end}',[
        'uses' => 'Dashboard\DashboardController@static'
    ])->name('dashboard.static');
    Route::get('/',[
        'uses' => 'Dashboard\DashboardController@indexView'
    ])->name('dashboard.index');
    Route::get('/403', function () {
        return view('layout/403');
    })->name('403');
    Route::get('/404', function () {
        return view('layout/404');
    });
});

Route::group([
    'prefix' => '/equipment',
], function (){
    Route::get('/index',[
        'uses' => 'Equipment\TypeOfEquipmentController@indexView'
    ])->name('equipment.index');
    Route::get('/store',[
        'uses' => 'Equipment\TypeOfEquipmentController@storeView'
    ])->name('equipment.store')->middleware('auth');
    Route::get('/edit/{id}',[
        'uses' => 'Equipment\TypeOfEquipmentController@editView'
    ])->name('equipment.edit')->middleware('auth');
    Route::get('/store-details/{id}',[
        'uses' => 'Equipment\EquipmentController@storeView'
    ])->name('equipment_details.store')->middleware('auth');
    Route::get('/edit-details/{id}',[
        'uses' => 'Equipment\EquipmentController@editView'
    ])->name('equipment_details.edit')->middleware('auth');
});

Route::group([
    'prefix' => '/reservation',
], function (){
    Route::get('/index',[
        'uses' => 'Reservations\EquipmentReservationController@indexView'
    ])->name('reservation.index');
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
    ])->name('lend_return.store')->middleware('auth');
    Route::get('/by/day',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@getLendReturnByDay'
    ]);
    Route::get('/return/view/{id}',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@returnView'
    ])->name('lend_return.returnView')->middleware('auth');
    Route::post('/return/{id}',[
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@return'
    ])->name('lend_return.return')->middleware('auth');
    Route::post('/', [
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@lend'
    ])->middleware('auth');
    Route::get('/print/{id}', [
        'uses' => 'LendReturnEquipment\LendReturnEquipmentController@printView'
    ])->name('lend_return.print');
});

Route::group([
    'prefix' => '/maintenance',
], function (){
    Route::get('/index', [
        'uses' => 'Maintenance\MaintenanceController@indexView'
    ])->name('maintenance.index');
    Route::get('/store',[
        'uses' => 'Maintenance\MaintenanceController@storeView'
    ])->name('maintenance.store')->middleware('auth');
    Route::post('/',[
        'uses' => 'Maintenance\MaintenanceController@store'
    ])->middleware('auth');
    Route::post('/start/{id}',[
        'uses' => 'Maintenance\MaintenanceController@startMaintenance'
    ])->name('maintenance.approved')->middleware('auth');
    Route::post('/cancel/{id}',[
        'uses' => 'Maintenance\MaintenanceController@cancel'
    ])->name('maintenance.cancel')->middleware('auth');
    Route::delete('/delete/{id}',[
        'uses' => 'Maintenance\MaintenanceController@delete'
    ])->name('maintenance.delete')->middleware('auth');
    Route::post('/end/{id}',[
        'uses' => 'Maintenance\MaintenanceController@endMaintenance'
    ])->name('maintenance.lend')->middleware('auth');
});

Route::group([
    'prefix' => '/liquidation',
], function (){
    Route::get('/index',[
        'uses' => 'Liquidation\LiquidationController@indexView'
    ])->name('liquidation.index');
    Route::get('/store',[
        'uses' => 'Liquidation\LiquidationController@storeView'
    ])->name('liquidation.store')->middleware('auth');
    Route::post('/',[
        'uses' => 'Liquidation\LiquidationController@store'
    ])->middleware('auth');
    Route::post('/approved/{id}',[
        'uses' => 'Liquidation\LiquidationController@approved'
    ])->name('liquidation.approved')->middleware('auth');
    Route::post('/cancel/{id}',[
        'uses' => 'Liquidation\LiquidationController@cancel'
    ])->name('liquidation.cancel')->middleware('auth');
    Route::delete('/delete/{id}',[
        'uses' => 'Liquidation\LiquidationController@delete'
    ])->name('liquidation.delete')->middleware('auth');
    Route::post('/success/{id}',[
        'uses' => 'Liquidation\LiquidationController@success'
    ])->name('liquidation.success')->middleware('auth');
});

//Route::group([
//    'prefix' => '/import',
//], function (){
//    Route::get('/index',[
//        'uses' => 'Reservations\EquipmentReservationController@indexView'
//    ])->name('reservation.index');
//    Route::get('/store',[
//        'uses' => 'Reservations\EquipmentReservationController@storeView'
//    ])->name('reservation.store')->middleware('auth');
//    Route::get('/filter',[
//        'uses' => 'Reservations\EquipmentReservationController@filter'
//    ])->name('reservation.filter')->middleware('auth');
//    Route::post('/',[
//        'uses' => 'Reservations\EquipmentReservationController@store'
//    ])->middleware('auth');
//    Route::post('/approved/{id}',[
//        'uses' => 'Reservations\EquipmentReservationController@approved'
//    ])->name('reservation.approved')->middleware('auth');
//    Route::post('/cancel/{id}',[
//        'uses' => 'Reservations\EquipmentReservationController@cancel'
//    ])->name('reservation.cancel')->middleware('auth');
//    Route::delete('/delete/{id}',[
//        'uses' => 'Reservations\EquipmentReservationController@delete'
//    ])->name('reservation.delete')->middleware('auth');
//    Route::post('/lend/{id}',[
//        'uses' => 'Reservations\EquipmentReservationController@lend'
//    ])->name('reservation.lend')->middleware('auth');
//});

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
    ])->name('profile.index')->middleware('auth');
    Route::get('/edit/{id}',[
        'uses' => 'User\UserProfileController@editView'
    ])->name('profile.edit')->middleware('auth');
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
