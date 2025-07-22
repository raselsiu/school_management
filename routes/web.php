<?php

use App\Http\Controllers\AssignSubjectController;
use App\Http\Controllers\Backend\AccSalaryController;
use App\Http\Controllers\Backend\ACCStudentFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeRegiController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Marks\AddMarksController;
use App\Http\Controllers\Backend\Marks\DefaultController;
use App\Http\Controllers\Backend\Marks\GradePointController;
use App\Http\Controllers\Backend\OtherCostController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ProfitReportController;
use App\Http\Controllers\Backend\Students\ExamFeeController;
use App\Http\Controllers\Backend\Students\MonthlyFeeController;
use App\Http\Controllers\Backend\Students\RegistrationFeeController;
use App\Http\Controllers\Backend\Students\RollController;
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
    if (Auth()) {
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
});


Auth::routes(['register' => false]);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



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

    // Student Registration

    Route::get('/registration/view', [StudentRegiController::class, 'view'])->name('studentRegiView');
    Route::get('/registration/add', [StudentRegiController::class, 'add'])->name('studentRegiAdd');
    Route::post('/registration/store', [StudentRegiController::class, 'store'])->name('studentRegiStore');
    Route::get('/registration/edit/{student_id}', [StudentRegiController::class, 'edit'])->name('studentRegiEdit');
    Route::post('/registration/update/{student_id}', [StudentRegiController::class, 'update'])->name('studentRegiUpdate');
    Route::get('/search-student-by-year-class', [StudentRegiController::class, 'searchYearClass'])->name('searchYearClass');
    Route::get('/promotion/{student_id}', [StudentRegiController::class, 'promotion'])->name('promotion');
    Route::post('/promotion/success/{student_id}', [StudentRegiController::class, 'promotionStore'])->name('promotionStore');
    Route::get('/details/{student_id}', [StudentRegiController::class, 'studentDetails'])->name('studentDetails');


    // Student Roll Generation

    Route::get('/roll/view', [RollController::class, 'studentRollView'])->name('studentRollView');
    Route::get('/roll/get-student', [RollController::class, 'getRollStudent'])->name('getRollStudent');
    Route::post('/roll/store', [RollController::class, 'studentRollStore'])->name('studentRollStore');

    // Registration Fee

    Route::get('regi/fee/view', [RegistrationFeeController::class, 'view'])->name('studentRegiFee');
    Route::get('/get-student-fee', [RegistrationFeeController::class, 'getStudentsFee'])->name('getStudentsFee');
    Route::get('/regi-fee-payslip', [RegistrationFeeController::class, 'paySlip'])->name('paySlip');

    // Monthly Fee

    Route::get('monthly/fee/view', [MonthlyFeeController::class, 'view'])->name('monthlyFeeView');
    Route::get('monthly/get-student', [MonthlyFeeController::class, 'getMonthlyFee'])->name('getMonthlyFee');
    Route::get('monthly/payslip', [MonthlyFeeController::class, 'monthlyFeePaySlip'])->name('monthlyFeePaySlip');

    // Exam Fee

    Route::get('exam/fee/view', [ExamFeeController::class, 'view'])->name('examFeeView');
    Route::get('exam/get-student', [ExamFeeController::class, 'getStudentsExamFee'])->name('getStudentsExamFee');
    Route::get('exam/payslip', [ExamFeeController::class, 'examFeePaySlip'])->name('examFeePaySlip');
});



Route::group(['prefix' => 'employees', 'middleware' => ['auth']], function () {

    // Employee Registration
    Route::get('regi/view', [EmployeeRegiController::class, 'view'])->name('employeeRegiView');
    Route::get('regi/add', [EmployeeRegiController::class, 'add'])->name('employeeRegiAdd');
    Route::post('regi/store', [EmployeeRegiController::class, 'store'])->name('employeeRegiStore');
    Route::get('regi/edit/{id}', [EmployeeRegiController::class, 'edit'])->name('employeeRegiEdit');
    Route::post('regi/update/{id}', [EmployeeRegiController::class, 'update'])->name('employeeRegiUpdate');
    Route::get('regi/delete/{id}', [EmployeeRegiController::class, 'delete'])->name('employeeRegiDelete');
    Route::get('regi/details/{id}', [EmployeeRegiController::class, 'details'])->name('employeeRegiDetails');

    // Employee Salary
    Route::get('salary/view', [EmployeeSalaryController::class, 'view'])->name('employeeSalaryView');
    Route::get('salary/increment/{id}', [EmployeeSalaryController::class, 'salaryIncrement'])->name('employeeSalaryIncrement');
    Route::post('salary/store/{id}', [EmployeeSalaryController::class, 'store'])->name('employeeSalaryStore');
    Route::get('salary/details/{id}', [EmployeeSalaryController::class, 'details'])->name('employeeSalaryDetails');

    // Employee Registration
    Route::get('leave/view', [EmployeeLeaveController::class, 'view'])->name('employeeLeaveView');
    Route::get('leave/add', [EmployeeLeaveController::class, 'add'])->name('employeeLeaveAdd');
    Route::post('leave/store', [EmployeeLeaveController::class, 'store'])->name('employeeLeaveStore');
    Route::get('leave/edit/{id}', [EmployeeLeaveController::class, 'edit'])->name('employeeLeaveEdit');
    Route::post('leave/update/{id}', [EmployeeLeaveController::class, 'update'])->name('employeeLeaveUpdate');

    // Employee Registration
    Route::get('attend/view', [EmployeeAttendanceController::class, 'view'])->name('employeeAttendView');
    Route::get('attend/add', [EmployeeAttendanceController::class, 'add'])->name('employeeAttendAdd');
    Route::post('attend/store', [EmployeeAttendanceController::class, 'store'])->name('employeeAttendStore');
    Route::get('attend/edit/{date}', [EmployeeAttendanceController::class, 'edit'])->name('employeeAttendEdit');
    Route::get('attend/details/{date}', [EmployeeAttendanceController::class, 'details'])->name('employeeAttendDetails');


    // Employee Registration
    Route::get('monthly/salary/view', [MonthlySalaryController::class, 'view'])->name('employeeMonthlySalaryView');
    Route::get('monthly/salary/get-salary', [MonthlySalaryController::class, 'getSalary'])->name('employeeMonthlySalaryGetSalary');
    Route::get('monthly/salary/pay-slip/{employee_id}', [MonthlySalaryController::class, 'paySlip'])->name('employeeMonthlySalaryPaySlip');
});


Route::group(['prefix' => 'marks', 'middleware' => ['auth']], function () {
    Route::get('marks/add', [AddMarksController::class, 'add'])->name('marksAdd');
    Route::post('store', [AddMarksController::class, 'store'])->name('storeMarks');
    Route::get('edit', [AddMarksController::class, 'edit'])->name('editMarks');
    Route::get('get-student-marks', [AddMarksController::class, 'getStudentMarks'])->name('getStudentMarks');
    Route::post('update-student-marks', [AddMarksController::class, 'updateStudentMarks'])->name('updateStudentMarks');

    // Grade Point
    Route::get('grade/view', [GradePointController::class, 'view'])->name('gradePointView');
    Route::get('grade/add', [GradePointController::class, 'add'])->name('gradePointAdd');
    Route::post('grade/store', [GradePointController::class, 'store'])->name('gradePointStore');
    Route::get('grade/edit/{id}', [GradePointController::class, 'edit'])->name('gradePointEdit');
    Route::post('grade/update/{id}', [GradePointController::class, 'update'])->name('gradePointUpdate');
});


Route::group(['prefix' => 'accounts', 'middleware' => ['auth']], function () {
    // Student Fee
    Route::get('student/fee/view', [ACCStudentFeeController::class, 'view'])->name('accStudentFeeView');
    Route::get('student/fee/add', [ACCStudentFeeController::class, 'add'])->name('accStudentFeeAdd');
    Route::post('student/fee/store', [ACCStudentFeeController::class, 'store'])->name('accStudentFeeStore');
    Route::get('student/get-student-fee', [ACCStudentFeeController::class, 'accGetStudent'])->name('accGetStudent');

    // Employee Salary
    Route::get('employee/salary/view', [AccSalaryController::class, 'view'])->name('accEmployeeSalaryView');
    Route::get('employee/salary/add', [AccSalaryController::class, 'add'])->name('accEmployeeSalaryAdd');
    Route::post('employee/salary/store', [AccSalaryController::class, 'store'])->name('accEmployeeSalaryStore');
    Route::get('employee/get-employee-salary', [AccSalaryController::class, 'accGetEmployee'])->name('accGetEmployee');

    //Others-Cost
    Route::get('others/cost/view',  [OtherCostController::class, 'view'])->name('OthersCostview');
    Route::get('others/cost/add',  [OtherCostController::class, 'add'])->name('OthersCostadd');
    Route::post('others/cost/store',  [OtherCostController::class, 'store'])->name('OthersCoststore');
    Route::get('others/cost/edit/{id}',  [OtherCostController::class, 'edit'])->name('OthersCostedit');
    Route::post('others/cost/update/{id}',  [OtherCostController::class, 'update'])->name('OthersCostupdate');
});

Route::group(['prefix' => 'reports', 'middleware' => ['auth']], function () {
    //Profit
    Route::get('/profit/view', [ProfitReportController::class, 'view'])->name('profitReportView');
    Route::get('/profit/get', [ProfitReportController::class, 'getProfit'])->name('getReportProfitDateWise');
    Route::get('/profit/pdf', [ProfitReportController::class, 'pdf'])->name('reportsProfitGeneratePdf');

    // marksheet
    Route::get('/marksheet/view', [ProfitReportController::class, 'markSheetView'])->name('markSheetView');
    Route::get('/marksheet/get', [ProfitReportController::class, 'getMarkSheet'])->name('getMarkSheet');

    // attendance
    Route::get('/attendance/view', [ProfitReportController::class, 'attendanceView'])->name('attendanceView');
    Route::get('/attendance/get', [ProfitReportController::class, 'getAttendance'])->name('getAttendance');

    // Student Result
    Route::get('student-result/view', [ProfitReportController::class, 'studentResultView'])->name('studentResultView');
    Route::get('student-result/get', [ProfitReportController::class, 'getStudentResult'])->name('getStudentResult');

    // Student Result
    Route::get('student-id-card/view', [ProfitReportController::class, 'studentIDCardView'])->name('studentIDCardView');
    Route::get('student-id-card/get', [ProfitReportController::class, 'getStudentIDCard'])->name('getStudentIDCard');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('get-student', [DefaultController::class, 'getStudent'])->name('getStudent');
    Route::get('get-subject', [DefaultController::class, 'getSubject'])->name('getSubject');
});
