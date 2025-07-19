<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AccountStudentFee;
use App\Models\AssignStudent;
use App\Models\CategoryFeeAmount;
use App\Models\StudentClassSetup;
use App\Models\StudentFeeSetup;
use App\Models\StudentYearSetup;
use Illuminate\Http\Request;

class ACCStudentFeeController extends Controller
{
    public function view()
    {
        $data['allData'] = AccountStudentFee::all();
        return view('backend.accounts.student_fee.view', $data);
    }

    public function add()
    {
        $data['years'] = StudentYearSetup::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClassSetup::all();
        $data['fee_categories'] = StudentFeeSetup::all();
        return view('backend.accounts.student_fee.add', $data);
    }

    public function accGetStudent(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m', strtotime($request->date));

        $data = AssignStudent::with(['discount'])->where('year_id', $year_id)->where('class_id', $class_id)->get();

        $html['thsource'] = '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Father Name</th>';
        $html['thsource'] .= '<th>Original Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This student)</th>';
        $html['thsource'] .= '<th>Select</th>';

        // Check if data is empty
        if ($data->isEmpty()) {
            $html['message'] = 'No students found for the selected criteria.';
            return response()->json($html);
        }

        foreach ($data as $key => $std) {
            // Initialize the tdsource key before using it
            $html[$key]['tdsource'] = '';

            $student_fee = CategoryFeeAmount::where('fee_category_id', $fee_category_id)
                ->where('class_id', $std->class_id)
                ->first();

            // Check if student_fee exists
            if (!$student_fee) {
                continue; // Skip this student if no fee amount is found
            }

            $accountstudentfees = AccountStudentFee::where('student_id', $std->student_id)
                ->where('year_id', $std->year_id)
                ->where('class_id', $std->class_id)
                ->where('fee_category_id', $fee_category_id)
                ->where('date', $date)
                ->first();

            $checked = ($accountstudentfees != null) ? 'checked' : '';

            $color = 'success';

            $html[$key]['tdsource'] .= '<td>' . $std['student']['id_no'] . '<input type="hidden" name="fee_category_id" value="' . $fee_category_id . '">' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $std['student']['name'] . '<input type="hidden" name="year_id" value="' . $std->year_id . '">' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $std['student']['fname'] . '<input type="hidden" name="class_id" value="' . $std->class_id . '">' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $student_fee->amount . 'TK' . '<input type="hidden" name="date" value="' . $date . '">' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $std['discount']['discount'] . '%' . '</td>';

            $originalfee = $student_fee->amount;
            $discount = $std['discount']['discount'];
            $discountablefee = $discount / 100 * $originalfee;
            $finalfee = (int)$originalfee - (int)$discountablefee;

            $html[$key]['tdsource'] .= '<td><input type="text" name="amount[]" value="' . $finalfee . '" class="form-control" readonly></td>';
            $html[$key]['tdsource'] .= '<td><input type="hidden" name="student_id[]" value="' . $std->student_id . '"><input type="checkbox" name="checkmanage[]" value="' . $key . '" ' . $checked . ' style="transform: scale(1.5);margin-left: 10px;"></td>';
        }

        return response()->json($html);
    }



    public function store(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        AccountStudentFee::where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('fee_category_id', $request->fee_category_id)->where('date', $date)->delete();
        $checkdata = $request->checkmanage;
        if ($checkdata != null) {
            for ($i = 0; $i < count($checkdata); $i++) {
                $data = new AccountStudentFee();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->date = $date;
                $data->fee_category_id = $request->fee_category_id;
                $data->student_id = $request->student_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];
                $data->save();
            }
        }

        if (!empty(@$data) || empty($checkdata)) {
            return redirect()->route('accStudentFeeView')->with('success', 'Well done! successfully updated');
        } else {
            return redirect()->back()->with('error', 'Sorry! Data not saved');
        }
    }
}
