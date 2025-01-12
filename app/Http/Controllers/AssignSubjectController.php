<?php

namespace App\Http\Controllers;

use App\Models\AssignSubject;
use App\Models\StudentClassSetup;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignSubjectController extends Controller
{
    public function view()
    {
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setups.assign_subject.view', $data);
    }

    public function add()
    {
        $data['subjects'] = Subject::all();
        $data['classes'] = StudentClassSetup::all();
        return view('backend.setups.assign_subject.add', $data);
    }


    public function store(Request $request)
    {


        // Validate the input data
        $request->validate([
            'class_id' => 'required|integer', // Check if class_id exists
            'subject_id' => 'required|array',                  // Ensure subject_id is an array
            'subject_id.*' => 'required|integer', // Validate each subject_id
            'full_mark' => 'required|array',                  // Ensure full_mark is an array
            'full_mark.*' => 'required|numeric|min:0',        // Validate each full_mark
            'pass_mark' => 'required|array',                  // Ensure pass_mark is an array
            'pass_mark.*' => 'required|numeric|min:0',        // Validate each pass_mark
            'get_mark' => 'required|array',                   // Ensure get_mark is an array
            'get_mark.*' => 'required|numeric|min:0',         // Validate each get_mark
        ]);


        $hasClass = count($request->subject_id);
        if ($hasClass != null) {
            $subject_id = $request->input('subject_id');
            $full_mark = $request->input('full_mark');
            $pass_mark = $request->input('pass_mark');
            $get_mark = $request->input('get_mark');

            foreach ($subject_id as $index => $sub_id) {


                $full_marks = $full_mark[$index];
                $pass_marks = $pass_mark[$index];
                $get_marks = $get_mark[$index];

                AssignSubject::create([
                    'class_id' => $request->class_id,
                    'subject_id' => $sub_id,
                    'full_mark' => $full_marks,
                    'pass_mark' => $pass_marks,
                    'get_mark' => $get_marks,
                ]);
            }
        }

        return redirect()->route('assignSubjectView')->with('success', 'Data saved successfully!');
    }




    public function edit(string $class_id)
    {
        $data['editData'] = AssignSubject::where('class_id', $class_id)->get();
        $data['subjects'] = Subject::all();
        $data['classes'] = StudentClassSetup::all();
        return view('backend.setups.assign_subject.edit', $data);
    }



    public function update(Request $request, string $class_id)
    {

        if ($request->subject_id == null) {
            return redirect()->back()->with('error', 'Something Wrong');
        } else {


            // Validate the input data
            $request->validate([
                'class_id' => 'required|integer', // Check if class_id exists
                'subject_id' => 'required|array',                  // Ensure subject_id is an array
                'subject_id.*' => 'required|integer', // Validate each subject_id
                'full_mark' => 'required|array',                  // Ensure full_mark is an array
                'full_mark.*' => 'required|numeric|min:0',        // Validate each full_mark
                'pass_mark' => 'required|array',                  // Ensure pass_mark is an array
                'pass_mark.*' => 'required|numeric|min:0',        // Validate each pass_mark
                'get_mark' => 'required|array',                   // Ensure get_mark is an array
                'get_mark.*' => 'required|numeric|min:0',         // Validate each get_mark
            ]);





            $hasClass = count($request->subject_id);
            if ($hasClass != null) {
                $subject_id = $request->input('subject_id');
                $full_mark = $request->input('full_mark');
                $pass_mark = $request->input('pass_mark');
                $get_mark = $request->input('get_mark');


                AssignSubject::where('class_id', $class_id)->delete();

                foreach ($subject_id as $index => $sub_id) {

                    $full_marks = $full_mark[$index];
                    $pass_marks = $pass_mark[$index];
                    $get_marks = $get_mark[$index];

                    AssignSubject::create([
                        'class_id' => $request->class_id,
                        'subject_id' => $sub_id,
                        'full_mark' => $full_marks,
                        'pass_mark' => $pass_marks,
                        'get_mark' => $get_marks,
                    ]);
                }
            }
            return redirect()->route('assignSubjectView')->with('success', 'Updated Successfully');
        }
    }



    public function show(string $class_id)
    {
        $data['editData'] = AssignSubject::where('class_id', $class_id)->get();
        return view('backend.setups.assign_subject.details', $data);
    }




    public function delete(string $id)
    {
        $data = AssignSubject::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Fee Category Deleted Successfully');
    }
}
