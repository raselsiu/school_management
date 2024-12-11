<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function view()
    {
        $data['allData'] = Designation::all();
        return view('backend.setups.designation.index', $data);
    }

    public function add()
    {
        return view('backend.setups.designation.add');
    }


    public function store(Request $request)
    {
        $data = new Designation();

        $this->validate($request, [
            'name' => 'required|unique:designations,name,' . $data->id
        ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->back()->with('success', 'Created Successfully');
    }

    public function edit(string $id)
    {
        $data['designation'] = Designation::find($id);
        return view('backend.setups.designation.edit', $data);
    }


    public function update(Request $request, string $id)
    {
        $data = Designation::find($id);
        $this->validate($request, [
            'name' => 'required|unique:designations,name,' . $data->id
        ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->route('designationView')->with('success', 'Updated Successfully');
    }


    public function delete(string $id)
    {
        $data = Designation::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
