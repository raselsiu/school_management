<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\MarksGrade;
use Illuminate\Http\Request;

class GradePointController extends Controller
{
    public function view()
    {
        $data['allData'] = MarksGrade::all();
        return view('backend.students.grade.view', $data);
    }

    public function add()
    {
        return view('backend.students.grade.add');
    }

    public function store(Request $request)
    {
        $data = new MarksGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();
        return redirect()->route('gradePointView')->with('success', 'Data Saved successfully!');
    }

    public function edit($id)
    {
        $data['editData'] = MarksGrade::find($id);
        return view('backend.students.grade.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $data = MarksGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();
        return redirect()->route('gradePointView')->with('success', 'Data Updated successfully!');
    }
}
