<?php

use App\Http\Controllers\AssignSubjectController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Students\StudentRegiController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\CategoryFeeAmountController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentFeeController;
use App\Http\Controllers\StudentGroupController;
use App\Http\Controllers\StudentShiftController;
use App\Http\Controllers\StudentYearController;
use App\Http\Controllers\SubjectController;
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

    // Student Fee Category Amount
    Route::get('/fee/category/amount/view', [CategoryFeeAmountController::class, 'view'])->name('studentFeeCategoryAmountView');
    Route::get('/fee/category/amount/add', [CategoryFeeAmountController::class, 'add'])->name('studentFeeCategoryAmountAdd');
    Route::post('/fee/category/amount/store', [CategoryFeeAmountController::class, 'store'])->name('studentFeeCategoryAmountStore');
    Route::get('/fee/category/amount/edit/{fee_category_id}', [CategoryFeeAmountController::class, 'edit'])->name('studentFeeCategoryAmountEdit');
    Route::get('/fee/category/amount/show/{fee_category_id}', [CategoryFeeAmountController::class, 'show'])->name('studentFeeCategoryAmountShow');
    Route::post('/fee/category/amount/update/{fee_category_id}', [CategoryFeeAmountController::class, 'update'])->name('studentFeeCategoryAmountUpdate');
    Route::get('/fee/category/amount/delete/{id}', [CategoryFeeAmountController::class, 'delete'])->name('studentFeeCategoryAmountDelete');

    // Exam Type
    Route::get('/exam/type/view', [ExamTypeController::class, 'view'])->name('examTypeView');
    Route::get('/exam/type/add', [ExamTypeController::class, 'add'])->name('examTypeAdd');
    Route::post('/exam/type/store', [ExamTypeController::class, 'store'])->name('examTypeStore');
    Route::get('/exam/type/edit/{id}', [ExamTypeController::class, 'edit'])->name('examTypeEdit');
    Route::post('/exam/type/update/{id}', [ExamTypeController::class, 'update'])->name('examTypeUpdate');
    Route::get('/exam/type/delete/{id}', [ExamTypeController::class, 'delete'])->name('examTypeDelete');

    // Subject Type
    Route::get('/subject/view', [SubjectController::class, 'view'])->name('subjectView');
    Route::get('/subject/add', [SubjectController::class, 'add'])->name('subjectAdd');
    Route::post('/subject/store', [SubjectController::class, 'store'])->name('subjectStore');
    Route::get('/subject/edit/{id}', [SubjectController::class, 'edit'])->name('subjectEdit');
    Route::post('/subject/update/{id}', [SubjectController::class, 'update'])->name('subjectUpdate');
    Route::get('/subject/delete/{id}', [SubjectController::class, 'delete'])->name('subjectDelete');

    // Assign Subject
    Route::get('/assign/subject/view', [AssignSubjectController::class, 'view'])->name('assignSubjectView');
    Route::get('/assign/subject/add', [AssignSubjectController::class, 'add'])->name('assignSubjectAdd');
    Route::post('/assign/subject/store', [AssignSubjectController::class, 'store'])->name('assignSubjectStore');
    Route::get('/assign/subject/edit/{class_id}', [AssignSubjectController::class, 'edit'])->name('assignSubjectEdit');
    Route::post('/assign/subject/update/{class_id}', [AssignSubjectController::class, 'update'])->name('assignSubjectUpdate');
    Route::get('/assign/subject/delete/{id}', [AssignSubjectController::class, 'delete'])->name('assignSubjectDelete');
    Route::get('/assign/subject/show/{class_id}', [AssignSubjectController::class, 'show'])->name('showAssignSubject');

    // Designation 
    Route::get('/designation/view', [DesignationController::class, 'view'])->name('designationView');
    Route::get('/designation/add', [DesignationController::class, 'add'])->name('designationAdd');
    Route::post('/designation/store', [DesignationController::class, 'store'])->name('designationStore');
    Route::get('/designation/edit/{id}', [DesignationController::class, 'edit'])->name('designationEdit');
    Route::post('/designation/update/{id}', [DesignationController::class, 'update'])->name('designationUpdate');
    Route::get('/designation/delete/{id}', [DesignationController::class, 'delete'])->name('designationDelete');
});


Route::group(['prefix' => 'students', 'middleware' => ['auth']], function () {
    Route::get('/registration/view', [StudentRegiController::class, 'view'])->name('studentRegiView');
    Route::get('/registration/add', [StudentRegiController::class, 'add'])->name('studentRegiAdd');
    Route::post('/registration/store', [StudentRegiController::class, 'store'])->name('studentRegiStore');
    Route::get('/registration/edit/{student_id}', [StudentRegiController::class, 'edit'])->name('studentRegiEdit');
    Route::post('/registration/update/{student_id}', [StudentRegiController::class, 'update'])->name('studentRegiUpdate');
    Route::get('/search-student-by-year-class', [StudentRegiController::class, 'searchYearClass'])->name('searchYearClass');
    Route::get('/promotion/{student_id}', [StudentRegiController::class, 'promotion'])->name('promotion');
    Route::post('/promotion/success/{student_id}', [StudentRegiController::class, 'promotionStore'])->name('promotionStore');

    Route::get('/details/{student_id}', [StudentRegiController::class, 'studentDetails'])->name('studentDetails');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
