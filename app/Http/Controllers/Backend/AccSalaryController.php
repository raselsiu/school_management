<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountStudentFee;
use App\Models\AssignStudent;
use App\Models\CategoryFeeAmount;
use App\Models\EmployeeAttendance;
use App\Models\StudentClassSetup;
use App\Models\StudentFeeSetup;
use App\Models\StudentYearSetup;
use Illuminate\Http\Request;

class AccSalaryController extends Controller
{
    public function view()
    {
        $data['allData'] = AccountEmployeeSalary::all();
        return view('backend.accounts.employee_salary.view', $data);
    }

    public function add()
    {
        $data['years'] = StudentYearSetup::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClassSetup::all();
        $data['fee_categories'] = StudentFeeSetup::all();
        return view('backend.accounts.employee_salary.add', $data);
    }

    public function accGetEmployee(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This month)</th>';
        $html['thsource'] .= '<th>Select</th>';
        foreach ($data as $key => $attend) {
            $account_salary = AccountEmployeeSalary::where('employee_id', $attend->employee_id)->where('date', $date)->first();
            if ($account_salary != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            $totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $attend->employee_id)->get();
            $absentcount = count($totalattend->where('attend_status', 'Absent'));
            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['id_no'] . '<input type="hidden" name="date" value="' . $date . '">' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['salary'] . '</td>';
            $salary = (float)$attend['user']['salary'];
            $salaryperday = (float)$salary / 30;
            $totalsalaryminus = (float)$absentcount * (float)$salaryperday;
            $totalsalary = (float)$salary - (float)$totalsalaryminus;
            $html[$key]['tdsource'] .= '<td>' . $totalsalary . '<input type="hidden" name="amount[]" value="' . $totalsalary . '"' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . '<input type="hidden" name="employee_id[]" value="' . $attend->employee_id . '">' . '<input type="checkbox" name="checkmanage[]" value="' . $key . '"' . $checked . ' style="transform: scale(1.5);margin-left: 10px;">' . '</td>';
        }
        return response()->json(@$html);
    }



    public function store(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        AccountEmployeeSalary::where('date', $date)->delete();
        $checkdata = $request->checkmanage;
        if ($checkdata != null) {
            for ($i = 0; $i < count($checkdata); $i++) {
                $data = new AccountEmployeeSalary();
                $data->date = $date;
                $data->employee_id = $request->employee_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];
                $data->save();
            }
        }
        if (!empty(@$data) || empty($checkdata)) {
            return redirect()->route('accEmployeeSalaryView')->with('success', 'Successfully updated');
        } else {
            return redirect()->back()->with('error', 'Sorry! Data not saved');
        }
    }
}
