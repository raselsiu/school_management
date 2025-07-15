<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    public function view()
    {
        $data['allData'] = EmployeeAttendance::orderBy('id', 'desc')->get();
        return view("backend.attend.view", $data);
    }


    public function add()
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        return view('backend.attend.add', $data);
    }


    public function store(Request $request)
    {
        $countemployee = count($request->employee_id);
        for ($i = 0; $i < $countemployee; $i++) {
            $attend_status = 'attend_status' . $i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        return redirect()->route('employeeAttendView')->with('success', 'Created successfully!');
    }



    public function edit(string $id)
    {
        $data['editData'] = EmployeeLeave::find($id);
        $data['employees'] = User::where('usertype', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        return view('backend.employee_leave.edit', $data);
    }


    public function update(Request $request, string $id)
    {

        if ($request->leave_purpose_id == "0") {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        } else {
            $leave_purpose_id = $request->leave_purpose_id;
        }
        $employee_leave = EmployeeLeave::find($id);
        $employee_leave->employee_id = $request->employee_id;
        $employee_leave->start_date = date('Y-m-d', strtotime($request->start_date));
        $employee_leave->end_date = date('Y-m-d', strtotime($request->end_date));
        $employee_leave->leave_purpose_id = $leave_purpose_id;
        $employee_leave->save();
        return redirect()->route('employeeLeaveView')->with('success', 'Data Updated successfully');
    }


    public function details(string $id)
    {

        $data['details'] = User::find($id);

        $pdf = Pdf::loadView('backend.employee.details_pdf', $data);
        return $pdf->stream('details.pdf');
    }
}
