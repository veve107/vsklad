<?php

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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(Auth::check()){
        return redirect('/home');
    }
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    // Home
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin/home', 'Admin\AdminController@home')->name('admin.home');

    // Sprava pouzivatelov
    Route::get('admin/users', 'Admin\AdminController@users')->name('admin.positions.users');
    Route::post('store/user', 'UserController@storeUser')->name('user.store');
    Route::get('edit/user/{id}', 'UserController@edit')->name('user.edit');
    Route::post('update/user/{id}', 'UserController@update')->name('user.update');
    Route::get('delete/user/{id}', 'UserController@delete')->name('user.delete');
    Route::get('user/profile/{id}', 'UserController@profile')->name('user.profile');

    // Sprava roli
    Route::get('admin/roles', 'Admin\AdminController@roles')->name('admin.positions.roles');
    Route::post('store/role', 'Admin\AdminController@storeRole')->name('store.role');
    Route::get('delete/role/{id}', 'Admin\AdminController@deleteRole')->name('delete.role');

    // Sprava pozicii
    Route::get('admin/positions', 'Admin\AdminController@positions')->name('admin.positions');
    Route::post('store/position', 'Admin\AdminController@storePosition')->name('store.position');
    Route::get('delete/position/{id}', 'Admin\AdminController@deletePosition')->name('delete.position');

    // Sprava oddeleni
    Route::get('admin/departments', 'Admin\AdminController@departments')->name('admin.positions.departments');
    Route::post('store/department', 'Admin\AdminController@storeDepartment')->name('store.department');
    Route::get('delete/department/{id}', 'Admin\AdminController@deleteDepartment')->name('delete.department');

    // Ziadosti
    Route::get('admin/request/add', 'RequestController@add')->name('request.add');
    Route::get('admin/request', 'RequestController@index')->name('request.index');
    Route::post('admin/request/store', 'RequestController@store')->name('request.store');
    Route::post('admin/request/process/{id}', 'RequestController@processStore')->name('process.store');
    Route::get('admin/request/process/{id}', 'RequestController@process')->name('request.process');
    Route::get('admin/request/process/{id}/mail', 'RequestController@sendMail')->name('request.sendMail');
    Route::get('admin/request/detail/{id}', 'RequestController@detail')->name('request.detail');
    Route::get('admin/request/edit/{id}', 'RequestController@edit')->name('request.edit');
    Route::get('admin/request/delete/{id}', 'RequestController@delete')->name('request.delete');
    Route::get('admin/request/verify/{id}', 'RequestController@verify')->name('request.verify');

    // Správa techniky
    Route::get('admin/hardware', 'Admin\HardwareController@hardware')->name('hardware.index');
    Route::get('admin/hardware/add', 'Admin\HardwareController@addHardware')->name('hardware.add');
    Route::post('admin/hardware/store', 'Admin\HardwareController@storeHardware')->name('hardware.store');

    Route::get('admin/types', 'Admin\HardwareController@types')->name('hardware.types');
    Route::post('admin/type/store', 'Admin\HardwareController@storeType')->name('store.type');
    Route::get('admin/type/delete/{id}', 'Admin\HardwareController@deleteType')->name('delete.type');

    Route::get('admin/orders', 'Admin\HardwareController@orders')->name('hardware.orders');
    Route::get('admin/add/order', 'Admin\HardwareController@addOrder')->name('add.order');
    Route::post('admin/order/store', 'Admin\HardwareController@storeOrder')->name('store.order');

    Route::get('admin/brands', 'Admin\HardwareController@brands')->name('hardware.brands');
    Route::post('admin/brands/store', 'Admin\HardwareController@storeBrand')->name('store.brand');

});

