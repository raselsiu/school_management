<?php

namespace App\Http\Controllers;

use App\Models\StudentYearSetup;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    public function view()
    {
        $data['allData'] = StudentYearSetup::all();
        return view('backend.student_year_Setup.index', $data);
    }

    public function add()
    {
        return view('backend.student_year_Setup.add');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:student_year_setups,name'
        ]);


        $data = new StudentYearSetup();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setupStudentYearView')->with('success', 'Year Created Successfully');
    }

    public function edit(string $id)
    {
        $data['year'] = StudentYearSetup::find($id);
        return view('backend.student_year_Setup.edit', $data);
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:student_year_setups,name'
        ]);

        $data = StudentYearSetup::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setupStudentYearView')->with('success', 'Year Updated Successfully');
    }


    public function delete(string $id)
    {
        $data = StudentYearSetup::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Year Deleted Successfully');
    }
}
