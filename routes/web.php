<?php

use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::group(['prefix' => 'users', 'middleware' => ['auth']], function(){
    Route::get('/view', [UserController::class, 'view'])->name('backUsersView');
    Route::get('/add', [UserController::class, 'add'])->name('backUsersAdd');
    Route::post('/store', [UserController::class, 'store'])->name('backUsersStore');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('backUsersEdit');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('backUsersUpdate');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('backUsersDelete');
});


Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function(){
    Route::get('/view', [ProfileController::class, 'view'])->name('profileView');
    Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('profileEdit');
    Route::post('/update/{id}', [ProfileController::class, 'update'])->name('profileUpdate');
    Route::get('/password/view', [ProfileController::class, 'passwordView'])->name('profilePasswordView');
    Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('updatePassword');
});

