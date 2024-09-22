<?php

namespace App\Http\Controllers;

use App\Models\StudentGroupSetup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    public function view()
    {
        $data['allData'] = StudentGroupSetup::all();
        return view('backend.setups.student_group_setup.index', $data);
    }

    public function add()
    {
        return view('backend.setups.student_group_setup.add');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:student_group_setups,name'
        ]);


        $data = new StudentGroupSetup();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setupStudentGroupView')->with('success', 'Group Created Successfully');
    }

    public function edit(string $id)
    {
        $data['group'] = StudentGroupSetup::find($id);
        return view('backend.setups.student_group_setup.edit', $data);
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:student_group_setups,name'
        ]);

        $data = StudentGroupSetup::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setupStudentGroupView')->with('success', 'Group Updated Successfully');
    }


    public function delete(string $id)
    {
        $data = StudentGroupSetup::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Group Deleted Successfully');
    }
}
