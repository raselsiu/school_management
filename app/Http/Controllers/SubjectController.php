<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function view()
    {
        $data['allData'] = Subject::all();
        return view('backend.subject.index', $data);
    }

    public function add()
    {
        return view('backend.subject.add');
    }


    public function store(Request $request)
    {
        $data = new Subject();

        $this->validate($request, [
            'name' => 'required|unique:subjects,name,' . $data->id
        ]);

        $data->name = $request->name;
        $data->save();

        return redirect()->back()->with('success', 'Subject Created Successfully');
    }

    public function edit(string $id)
    {
        $data['subject'] = Subject::find($id);
        return view('backend.subject.edit', $data);
    }


    public function update(Request $request, string $id)
    {
        $data = Subject::find($id);
        $this->validate($request, [
            'name' => 'required|unique:subjects,name,' . $data->id
        ]);


        $data->name = $request->name;
        $data->save();

        return redirect()->route('subjectView')->with('success', 'Subject Updated Successfully');
    }


    public function delete(string $id)
    {
        $data = Subject::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Subject Deleted Successfully');
    }
}
