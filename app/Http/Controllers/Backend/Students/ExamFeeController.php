<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\CategoryFeeAmount;
use App\Models\ExamType;
use App\Models\StudentClassSetup;
use App\Models\StudentYearSetup;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExamFeeController extends Controller
{
    public function view()
    {
        $data['years'] = StudentYearSetup::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClassSetup::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.students.exam_fee.view', $data);
    }



    public function examFeePaySlip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['exam_name'] = ExamType::where('id', $request->exam_type_id)->first()['name'];
        $data['details'] = AssignStudent::with(['discount', 'student'])->where('student_id', $student_id)->where('class_id', $class_id)->first();

        $pdf = Pdf::loadView('backend.students.exam_fee.fee_payslip', $data);
        return $pdf->stream('exam_fee.pdf');
    }


    public function getStudentsExamFee(Request $request)
    {

        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if ($year_id != '') {
            $where[] = ['year_id', 'like', $year_id . '%'];
        }

        if ($class_id != '') {
            $where[] = ['class_id', 'like', $class_id . '%'];
        }

        $allStudent = AssignStudent::with(['discount'])->where($where)->get();
        // dd($allStudent);

        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Exam Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($allStudent as $key => $v) {
            $registrationfee = CategoryFeeAmount::where('fee_category_id', '1')->where('class_id', $v->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource']  = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['id_no'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v->roll . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $registrationfee->amount . 'TK' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['discount']['discount'] . '%' . '</td>';

            $originalfee = $registrationfee->amount;
            $discount = $v['discount']['discount'];
            $discountablefee = $discount / 100 * $originalfee;
            $finalfee = (float)$originalfee - (float)$discountablefee;

            $html[$key]['tdsource'] .= '<td>' . $finalfee . 'TK' . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= ' <a class="btn btn-sm btn-' . $color . '" title="Payslip" target="_blank" href="' . route('examFeePaySlip') . '?class_id=' . $v->class_id . '&student_id=' . $v->student_id . '&exam_type_id=' . $request->exam_type_id . '">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }
}
