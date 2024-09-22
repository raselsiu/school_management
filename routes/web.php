<?php

use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentFeeController;
use App\Http\Controllers\StudentGroupController;
use App\Http\Controllers\StudentShiftController;
use App\Http\Controllers\StudentYearController;
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



Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/view', [UserController::class, 'view'])->name('backUsersView');
    Route::get('/add', [UserController::class, 'add'])->name('backUsersAdd');
    Route::post('/store', [UserController::class, 'store'])->name('backUsersStore');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('backUsersEdit');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('backUsersUpdate');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('backUsersDelete');
});


Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function () {
    Route::get('/view', [ProfileController::class, 'view'])->name('profileView');
    Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('profileEdit');
    Route::post('/update/{id}', [ProfileController::class, 'update'])->name('profileUpdate');
    Route::get('/password/view', [ProfileController::class, 'passwordView'])->name('profilePasswordView');
    Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('updatePassword');
});

Route::group(['prefix' => 'setup', 'middleware' => ['auth']], function () {
    // Student Class
    Route::get('/student/class/view', [StudentClassController::class, 'view'])->name('setupStudentClassView');
    Route::get('/student/class/add', [StudentClassController::class, 'add'])->name('setupStudentClassAdd');
    Route::post('/student/class/store', [StudentClassController::class, 'store'])->name('setupStudentClassStore');
    Route::get('/student/class/edit/{id}', [StudentClassController::class, 'edit'])->name('setupStudentClassEdit');
    Route::post('/student/class/update/{id}', [StudentClassController::class, 'update'])->name('setupStudentClassUpdate');
    Route::get('/student/class/delete/{id}', [StudentClassController::class, 'delete'])->name('setupStudentClassDelete');
    // Student Year
    Route::get('/student/year/view', [StudentYearController::class, 'view'])->name('setupStudentYearView');
    Route::get('/student/year/add', [StudentYearController::class, 'add'])->name('setupStudentYearAdd');
    Route::post('/student/year/store', [StudentYearController::class, 'store'])->name('setupStudentYearStore');
    Route::get('/student/year/edit/{id}', [StudentYearController::class, 'edit'])->name('setupStudentYearEdit');
    Route::post('/student/year/update/{id}', [StudentYearController::class, 'update'])->name('setupStudentYearUpdate');
    Route::get('/student/year/delete/{id}', [StudentYearController::class, 'delete'])->name('setupStudentYearDelete');
    // Student Group
    Route::get('/student/group/view', [StudentGroupController::class, 'view'])->name('setupStudentGroupView');
    Route::get('/student/group/add', [StudentGroupController::class, 'add'])->name('setupStudentGroupAdd');
    Route::post('/student/group/store', [StudentGroupController::class, 'store'])->name('setupStudentGroupStore');
    Route::get('/student/group/edit/{id}', [StudentGroupController::class, 'edit'])->name('setupStudentGroupEdit');
    Route::post('/student/group/update/{id}', [StudentGroupController::class, 'update'])->name('setupStudentGroupUpdate');
    Route::get('/student/group/delete/{id}', [StudentGroupController::class, 'delete'])->name('setupStudentGroupDelete');
    // Student Shift
    Route::get('/student/shift/view', [StudentShiftController::class, 'view'])->name('setupStudentShiftView');
    Route::get('/student/shift/add', [StudentShiftController::class, 'add'])->name('setupStudentShiftAdd');
    Route::post('/student/shift/store', [StudentShiftController::class, 'store'])->name('setupStudentShiftStore');
    Route::get('/student/shift/edit/{id}', [StudentShiftController::class, 'edit'])->name('setupStudentShiftEdit');
    Route::post('/student/shift/update/{id}', [StudentShiftController::class, 'update'])->name('setupStudentShiftUpdate');
    Route::get('/student/shift/delete/{id}', [StudentShiftController::class, 'delete'])->name('setupStudentShiftDelete');

    // Student Fee Category
    Route::get('/fee/category/view', [StudentFeeController::class, 'view'])->name('setupStudentFeeView');
    Route::get('/fee/category/add', [StudentFeeController::class, 'add'])->name('setupStudentFeeAdd');
    Route::post('/fee/category/store', [StudentFeeController::class, 'store'])->name('setupStudentFeeStore');
    Route::get('/fee/category/edit/{id}', [StudentFeeController::class, 'edit'])->name('setupStudentFeeEdit');
    Route::post('/fee/category/update/{id}', [StudentFeeController::class, 'update'])->name('setupStudentFeeUpdate');
    Route::get('/fee/category/delete/{id}', [StudentFeeController::class, 'delete'])->name('setupStudentFeeDelete');
});
