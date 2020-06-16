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


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function(){
    // Home
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin/home', 'Admin\AdminController@home')->name('admin.home');

    // Sprava pouzivatelov
    Route::get('admin/users', 'Admin\AdminController@users')->name('admin.users');
    Route::post('store/user', 'UserController@storeUser')->name('store.user');
    Route::get('delete/user/{id}', 'UserController@delete')->name('delete.user');

    // Sprava roli
    Route::get('admin/roles', 'Admin\AdminController@roles')->name('admin.roles');
    Route::post('store/role', 'Admin\AdminController@storeEole')->name('store.role');
    Route::get('delete/role/{id}', 'Admin\AdminController@deleteRole')->name('delete.role');

    // Sprava pozicii
    Route::get('admin/positions', 'Admin\AdminController@positions')->name('admin.positions');
    Route::post('store/position', 'Admin\AdminController@storePosition')->name('store.position');
    Route::get('delete/position/{id}', 'Admin\AdminController@deletePosition')->name('delete.position');

    // Ziadosti
    Route::get('admin/request','RequestController@request')->name('request');

    // Správa techniky
    Route::get('admin/hardware','Admin\HardwareController@hardware')->name('hardware');
    Route::get('admin/hardware/add','Admin\HardwareController@addHardware')->name('add.hardware');
    Route::post('admin/hardware/store','Admin\HardwareController@storeHardware')->name('store.hardware');

    Route::get('admin/types','Admin\HardwareController@types')->name('types');
    Route::post('admin/type/store','Admin\HardwareController@storeType')->name('store.type');
    Route::get('admin/orders', 'Admin\HardwareController@orders')->name('orders');
    Route::get('admin/add/order', 'Admin\HardwareController@addOrder')->name('add.order');
    Route::post('admin/order/store','Admin\HardwareController@storeOrder')->name('store.order');

});

