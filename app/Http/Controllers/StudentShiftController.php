<?php

namespace App\Http\Controllers;

use App\Models\StudentShiftSetup;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    public function view()
    {
        $data['allData'] = StudentShiftSetup::all();
        return view('backend.setups.student_shift_setup.index', $data);
    }

    public function add()
    {
        return view('backend.setups.student_shift_setup.add');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:student_shift_setups,name'
        ]);


        $data = new StudentShiftSetup();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setupStudentShiftView')->with('success', 'Shift Created Successfully');
    }

    public function edit(string $id)
    {
        $data['shift'] = StudentShiftSetup::find($id);
        return view('backend.setups.student_shift_setup.edit', $data);
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:student_shift_setups,name'
        ]);

        $data = StudentShiftSetup::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setupStudentShiftView')->with('success', 'Shift Updated Successfully');
    }


    public function delete(string $id)
    {
        $data = StudentShiftSetup::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Shift Deleted Successfully');
    }
}
