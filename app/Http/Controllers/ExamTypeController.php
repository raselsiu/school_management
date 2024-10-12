<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    public function view()
    {
        $data['allData'] = ExamType::all();
        return view('backend.exam_type.index', $data);
    }

    public function add()
    {
        return view('backend.exam_type.add');
    }


    public function store(Request $request)
    {
        $data = new ExamType();

        $this->validate($request, [
            'name' => 'required|unique:exam_types,name,' . $data->id
        ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->back()->with('success', 'Exam Type Created Successfully');
    }

    public function edit(string $id)
    {
        $data['examType'] = ExamType::find($id);
        return view('backend.exam_type.edit', $data);
    }


    public function update(Request $request, string $id)
    {
        $data = ExamType::find($id);
        $this->validate($request, [
            'name' => 'required|unique:exam_types,name,' . $data->id
        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('examTypeView')->with('success', 'Class Updated Successfully');
    }


    public function delete(string $id)
    {
        $data = ExamType::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Class Deleted Successfully');
    }
}
