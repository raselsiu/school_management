<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MonthlySalaryController extends Controller
{
    public function view()
    {

        return view('backend.monthly_salary.view');
    }
    public function getSalary(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This month)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($data as $key => $attend) {
            $totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $attend->employee_id)->get();
            $absentcount = count($totalattend->where('attend_status', 'Absent'));
            $color = 'success';
            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['salary'] . '</td>';
            $salary = (float)$attend['user']['salary'];
            $salaryperday = (float)$salary / 30;
            $totalsalaryminus = (float)$absentcount * (float)$salaryperday;
            $totalsalary = (float)$salary - (float)$totalsalaryminus;
            $html[$key]['tdsource'] .= '<td>' . $totalsalary . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-' . $color . '" title="Payslip" target="_blank" href="' . route('employeeMonthlySalaryPaySlip', $attend->employee_id) . '">Pay Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json($html);
    }

    public function paySlip(Request $request, $employee_id)
    {
        $id = EmployeeAttendance::where('employee_id', $employee_id)->first();
        $date = date('Y-m', strtotime($id->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }
        $data['totalattendgroupbyid'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $id->employee_id)->get();

        $pdf = Pdf::loadView('backend.monthly_salary.pay_slip', $data);
        return $pdf->stream('document.pdf');
    }
}
