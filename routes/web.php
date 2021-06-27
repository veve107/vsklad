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


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HardwareController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
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
    Route::get('/home', [AdminController::class, 'home'])->name('admin.home');

    Route::group(['middleware' => ['isTechnician'], 'prefix' => 'admin'], function(){
        // Administrativa pouzivatelov
        Route::group(['middleware' => ['isAdmin'], 'prefix' => 'user'], function(){
            Route::get('/index', [UserController::class, 'users'])->name('users');
            Route::post('/store', [UserController::class, 'storeUser'])->name('user.store');
            Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        });

        // Sprava roli
        /*Route::prefix('role')->group(function(){
            Route::get('/index', [AdminController::class, 'roles'])->name('roles');
            Route::post('/store', [AdminController::class, 'storeRole'])->name('role.store');
            Route::get('/delete/{id}', [AdminController::class, 'deleteRole'])->name('role.delete');
        });*/

        // Sprava pozicii
        Route::prefix('position')->group(function(){
            Route::get('/index', [AdminController::class, 'positions'])->name('users.positions');
            Route::post('/store', [AdminController::class, 'storePosition'])->name('position.store');
            Route::get('/delete/{id}', [AdminController::class, 'deletePosition'])->name('position.delete');
            Route::post('/update/{id}', [AdminController::class, 'updatePosition'])->name('position.update');
            Route::post('/update', function(){
                return back();
            })->name('position.update.dummy');
        });

        // Sprava oddeleni
        Route::prefix('department')->group(function(){
            Route::get('/index', [AdminController::class, 'departments'])->name('users.departments');
            Route::post('/store', [AdminController::class, 'storeDepartment'])->name('department.store');
            Route::get('/delete/{id}', [AdminController::class, 'deleteDepartment'])->name('department.delete');
            Route::post('/update/{id}', [AdminController::class, 'updateDepartment'])->name('department.update');
            Route::post('/update', function(){
                return back();
            })->name('department.update.dummy');
        });

        // Sprava zariadeni
        Route::prefix('hardware')->group(function(){
            Route::get('/index', [HardwareController::class, 'hardware'])->name('hardware');
            Route::get('/add', [HardwareController::class, 'addHardware'])->name('hardware.add');
            Route::post('/store', [HardwareController::class, 'storeHardware'])->name('hardware.store');
        });

        // Sprava typov zariadeni
        Route::prefix('type')->group(function(){
            Route::get('/index', [HardwareController::class, 'types'])->name('hardware.types');
            Route::post('/store', [HardwareController::class, 'storeType'])->name('type.store');
            Route::post('/update/{id}', [HardwareController::class, 'updateType'])->name('type.update');
            Route::get('/delete/{id}', [HardwareController::class, 'deleteType'])->name('type.delete');
            Route::post('/update', function(){ return redirect()->back();})->name('type.update.dummy');
        });

        // Sprava objednavok
        Route::prefix('order')->group(function(){
            Route::get('/index', [HardwareController::class, 'orders'])->name('hardware.orders');
            Route::post('/store', [HardwareController::class, 'storeOrder'])->name('order.store');
            Route::get('/delete/{id}', [HardwareController::class, 'deleteOrder'])->name('order.delete');
        });

        // Sprava znaciek
        Route::prefix('brand')->group(function(){
            Route::get('/index', [HardwareController::class, 'brands'])->name('hardware.brands');
            Route::post('/store', [HardwareController::class, 'storeBrand'])->name('brand.store');
            Route::post('/update/{id}', [HardwareController::class, 'updateBrand'])->name('brand.update');
            Route::get('/delete/{id}', [HardwareController::class, 'deleteBrand'])->name('brand.delete');
            Route::post('/update', function(){ return redirect()->back();})->name('brand.update.dummy');

        });

        // Sprava ziadosti Admin
        Route::prefix('request')->group(function(){
            Route::get('/process/{id}', [RequestController::class, 'process'])->name('request.process');
            Route::post('/process/{id}', [RequestController::class, 'processStore'])->name('request.process.store');
            Route::get('/process/{id}/issue', [RequestController::class, 'processForIssue'])->name('request.processForIssue');
            Route::get('/confirm/{id}', [RequestController::class, 'confirmReturnRequest'])->name('request.confirm');

        });
    });

    // Sprava jedneho pouzivatela
    Route::prefix('user')->group(function(){
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/profile/{id}', [UserController::class, 'profile'])->name('user.profile');
    });

    // Sprava ziadosti Pouzivatel
    Route::prefix('request')->group(function(){
        Route::get('/index', [RequestController::class, 'index'])->name('request.index');
        Route::get('/add', [RequestController::class, 'add'])->name('request.add');
        Route::post('/store', [RequestController::class, 'store'])->name('request.store');
        Route::get('/detail/{id}', [RequestController::class, 'detail'])->name('request.detail');
        Route::get('/edit/{id}', [RequestController::class, 'edit'])->name('request.edit');
        Route::get('/delete/{id}', [RequestController::class, 'delete'])->name('request.delete');
        Route::get('/receive/{id}', [RequestController::class, 'receive'])->name('request.receive');
        Route::get('/return/{id}', [RequestController::class, 'returnRequest'])->name('request.return');
        Route::post('/return', [RequestController::class, 'returnStore'])->name('request.return.store');
    });
});

