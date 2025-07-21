<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\AccountStudentFee;
use App\Models\EmployeeAttendance;
use App\Models\ExamType;
use App\Models\MarksGrade;
use App\Models\StudentClassSetup;
use App\Models\StudentMarks;
use App\Models\StudentYearSetup;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProfitReportController extends Controller
{
    public function view()
    {
        return view('backend.reports.monthly_profit.view');
    }

    public function getProfit(Request $request)
    {
        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $total_cost = $other_cost + $emp_salary;
        $profit = $student_fee - $total_cost;

        $html['thsource']  = '<th>Students Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit</th>';
        $html['thsource'] .= '<th>Action</th>';
        $color = 'success';
        $html['tdsource']  = '<td>' . $student_fee . '</td>';
        $html['tdsource'] .= '<td>' . $other_cost . '</td>';
        $html['tdsource'] .= '<td>' . $emp_salary . '</td>';
        $html['tdsource'] .= '<td>' . $total_cost . '</td>';
        $html['tdsource'] .= '<td>' . $profit . '</td>';
        $html['tdsource'] .= '<td>' . '<a class="btn btn-sm btn-' . $color . '" title="PDF" target="_blank" href="' . route('reportsProfitGeneratePdf') . '?start_date=' . $sdate . '&end_date=' . $edate . '"><i class="fa fa-file"></i></a>' . '</td>';;
        $html['tdsource'] .= '</td>';

        return response()->json(@$html);
    }

    public function pdf(Request $request)
    {


        $data['sdate'] = date('Y-m', strtotime($request->start_date));
        $data['edate'] = date('Y-m', strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
        $pdf = Pdf::loadView('backend.reports.monthly_profit.pdf', $data);
        return $pdf->stream('document.pdf');
    }


    public function markSheetView()
    {
        $data['years'] = StudentYearSetup::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClassSetup::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.reports.marksheet.view', $data);
    }

    public function getMarkSheet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;
        $count_fail = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->where('marks', '<', '33')->get()->count();
        // dd($count_fail);
        $singleStudent = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->first();

        if ($singleStudent == true) {
            $allMarks = StudentMarks::with(['assign_subject', 'year'])->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->get();
            $allGreades = MarksGrade::all();
            return view('backend.reports.marksheet.marksheet_print', compact('allMarks', 'allGreades', 'count_fail'));
        } else {
            return redirect()->back()->with('error', 'Sorry! These criteria does not match!');
        }
    }

    public function attendanceView()
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        return view('backend.reports.attendance.view', $data);
    }


    public function getAttendance(Request $request)
    {
        $employee_id = $request->employee_id;
        if ($employee_id != '') {
            $where[] = ['employee_id', $employee_id];
        }
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

        $singleAttendance = EmployeeAttendance::with(['user'])->where($where)->first();
        if ($singleAttendance == true) {
            $data['allData'] = EmployeeAttendance::with(['user'])->where($where)->get();
            $data['absents'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status', 'Absent')->get()->count();
            $data['leaves'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status', 'Leave')->get()->count();
            $data['month'] = date('M Y', strtotime($request->date));
            $pdf = Pdf::loadView('backend.reports.attendance.attendance', $data);
            return $pdf->stream('attendance.pdf');
        } else {
            return redirect()->back()->with('error', 'Sorry! These criteria does not match!');
        }
    }


    public function studentResultView()
    {
        $data['years'] = StudentYearSetup::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClassSetup::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.reports.results.view', $data);
    }


    public function getStudentResult(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;

        $singleResult = StudentMarks::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('exam_type_id', $exam_type_id)
            ->first();

        if ($singleResult == true) {
            $data['allData'] = StudentMarks::select('year_id', 'class_id', 'exam_type_id', 'student_id')
                ->where('year_id', $year_id)
                ->where('class_id', $class_id)
                ->where('exam_type_id', $exam_type_id)
                ->groupBy('year_id', 'class_id', 'exam_type_id', 'student_id')
                ->get();

            $pdf = PDF::loadView('backend.reports.results.result_pdf', $data);
            return $pdf->stream('document.pdf');
        } else {
            return redirect()->back()->with('error', 'Sorry! These criteria does not match!');
        }
    }
}
