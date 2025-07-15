<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\EmployeeSalaryLog;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EmployeeRegiController extends Controller
{


    public function view()
    {
        $data['allData'] = User::where('usertype', 'employee')->get();
        return view("backend.employee.view", $data);
    }


    public function add()
    {
        $data['designaton'] = Designation::all();
        return view('backend.employee.add', $data);
    }


    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {
            $checkYear = Date('Ym', strtotime($request->join_date));
            $employee = User::where('usertype', 'employee')->orderBy('id', 'desc')->first();
            if ($employee == null) {
                $firstreg = 0;
                $employeeId = $firstreg + 1;
                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } elseif ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } elseif ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }
            } else {
                $employee = User::where('usertype', 'employee')->orderBy('id', 'desc')->first()->id;
                $employeeId = $employee + 1;
                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } elseif ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } elseif ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }
            }
            $final_id_no = $checkYear . $id_no;

            $user = new User();
            $code = rand(0000, 9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->name = $request->name;
            $user->usertype = 'employee';
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->relegion = $request->religion;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->join_date = date('Y-m-d', strtotime($request->join_date));

            // Image insertion

            $folderPath = public_path('upload/employee_image');

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }

            if ($request->file('image')) {
                $file = $request->file('image');
                $fileName = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/employee_image'), $fileName);
                $user->image = $fileName;
            }

            $user->save();

            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_date = Date('Y-m-d', strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = "0";
            $employee_salary->save();
        });

        return redirect()->route('employeeRegiView')->with('success', 'Data Saved Successfully!');
    }



    public function edit(string $id)
    {
        $data['editData'] = User::find($id);
        $data['designaton'] = Designation::all();
        return view('backend.employee.edit', $data);
    }


    public function update(Request $request, string $id)
    {



        $user = User::find($id);
        $user->name = $request->name;
        $user->fname = $request->fname;
        $user->mname = $request->mname;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->relegion = $request->religion;
        $user->designation_id = $request->designation_id;
        $user->dob = date('Y-m-d', strtotime($request->dob));

        // Image insertion

        $folderPath = public_path('upload/employee_image');

        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true, true);
        }

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/employee_image/' . $user->image));
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/employee_image'), $fileName);
            $user->image = $fileName;
        }

        $user->save();

        return redirect()->route('employeeRegiView')->with('success', 'Data Updated Successfully!');
    }


    public function details(string $id)
    {

        $data['details'] = User::find($id);

        $pdf = Pdf::loadView('backend.employee.details_pdf', $data);
        return $pdf->stream('details.pdf');
    }
}
