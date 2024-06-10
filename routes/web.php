<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\CheckInOutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\DatacenterController;
use App\Http\Controllers\RackController;

use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('IsGuest')->group(function () {
    // ketika akses link pertama kali yg dimunculin halaman login
    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    
    Route::fallback(function () {
        return view('errors.404');
    });
    
    Route::post('/loginAdmin', [UserController::class, 'authLogin'])->name('auth-login');
    Route::patch('/checkout/{id}', [CheckInOutController::class, 'checkout'])->name('checkout');

    Route::prefix('/guest')->name('guest.')->group(function () {

        Route::get('/index', [GuestController::class, 'index'])->name('index');
        

        Route::prefix('/guest')->name('guest.')->group(function () {
            Route::get('/create', [GuestController::class, 'create'])->name('create');
            Route::post('/store', [GuestController::class, 'store'])->name('store');
            });
            
            Route::prefix('/returner')->name('returner.')->group(function () {
                Route::get('/', [GuestController::class, 'returnerIndex'])->name('index');
                Route::get('/search', [GuestController::class, 'search'])->name('search');
                Route::get('/liveSearch', [GuestController::class, 'liveSearch'])->name('liveSearch');
                Route::post('/create', [GuestController::class, 'accountCreate'])->name('account-create');
                Route::post('/update/{id}', [GuestController::class, 'returnerUpdate'])->name('update');
        });
    
    });
});

Route::middleware('IsLogin')->group(function () {

    Route::get('/logout', [UserController::class, 'logout'])->name('auth-logout');
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
  
    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/datacenter', [DatacenterController::class, 'create'])->name('datacenter');
        Route::post('/datacenter/store', [DatacenterController::class, 'store'])->name('datacenter.store');
        Route::get('/rack', [RackController::class, 'create'])->name('rack');
        Route::post('/rack/store', [RackController::class, 'store'])->name('rack.store');
        Route::get('/activities', [ActivitiesController::class, 'create'])->name('activities');
        Route::post('/activities/store', [ActivitiesController::class, 'store'])->name('activities.store');
    });


});