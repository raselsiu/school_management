<?php

namespace App\Http\Controllers;

use App\Models\StudentFeeSetup;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
    public function view()
    {
        $data['allData'] = StudentFeeSetup::all();
        return view('backend.setups.student_fee_category.index', $data);
    }

    public function add()
    {
        return view('backend.setups.student_fee_category.add');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:student_fee_setups,name'
        ]);


        $data = new StudentFeeSetup();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setupStudentFeeView')->with('success', 'Fee Category Created Successfully');
    }

    public function edit(string $id)
    {
        $data['fee'] = StudentFeeSetup::find($id);
        return view('backend.setups.student_fee_category.edit', $data);
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:student_fee_setups,name'
        ]);

        $data = StudentFeeSetup::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('setupStudentFeeView')->with('success', 'Fee Category Updated Successfully');
    }


    public function delete(string $id)
    {
        $data = StudentFeeSetup::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Fee Category Deleted Successfully');
    }
}
