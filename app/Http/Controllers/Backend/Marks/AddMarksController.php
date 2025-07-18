<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamType;
use App\Models\StudentClassSetup;
use App\Models\StudentMarks;
use App\Models\StudentYearSetup;
use Illuminate\Http\Request;

class AddMarksController extends Controller
{
    public function add()
    {
        $data['years'] = StudentYearSetup::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClassSetup::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.students.marks.add', $data);
    }

    public function store(Request $request)
    {
        $studentcount = $request->student_id;
        if ($studentcount) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }
        }
        return redirect()->back()->with('success', 'Marks Created successfully!');
    }

    public function edit()
    {
        $data['years'] = StudentYearSetup::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClassSetup::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.students.marks.edit', $data);
    }

    public function getStudentMarks(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;
        $getStudent = StudentMarks::with(['student'])->where('year_id', $year_id)->where('class_id', $class_id)->where('assign_subject_id', $assign_subject_id)->where('exam_type_id', $exam_type_id)->get();
        return response()->json($getStudent);
    }



    public function updateStudentMarks(Request $request)
    {
        StudentMarks::where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('assign_subject_id', $request->assign_subject_id)->where('exam_type_id', $request->exam_type_id)->delete();
        $studentcount = $request->student_id;
        if ($studentcount) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }
        }
        return redirect()->back()->with('success', 'Marks updated successfully!');
    }
}
