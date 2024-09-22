<?php

namespace App\Http\Controllers;

use App\Models\StudentClassSetup;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function view()
    {
        $data['allData'] = StudentClassSetup::all();
        return view('backend.student_class_setup.index', $data);
    }

    public function add()
    {
        return view('backend.student_class_setup.add');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:student_class_setups,name'
        ]);


        $data = new StudentClassSetup();
        $data->name = $request->name;
        $data->save();

        return redirect()->back()->with('success', 'Class Created Successfully');
    }

    public function edit(string $id)
    {
        $data['class'] = StudentClassSetup::find($id);
        return view('backend.student_class_setup.edit', $data);
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:student_class_setups,name'
        ]);

        $data = StudentClassSetup::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setupStudentClassView')->with('success', 'Class Updated Successfully');
    }


    public function delete(string $id)
    {
        $data = StudentClassSetup::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Class Deleted Successfully');
    }
}
