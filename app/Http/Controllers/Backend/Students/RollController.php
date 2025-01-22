<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClassSetup;
use App\Models\StudentYearSetup;
use Illuminate\Http\Request;

class RollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function studentRollView()
    {
        @$data['years'] = StudentYearSetup::orderBy('id', 'desc')->get();
        @$data['classes'] = StudentClassSetup::all();

        return view("backend.students.roll_generate.roll_view", $data);
    }

    public function getRollStudent(Request $request){
       $allData = AssignStudent::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        return response()->json($allData);
    }



    public function studentRollStore(Request $request)
{
    $year_id = $request->year_id;
    $class_id = $request->class_id;

    if ($request->student_id != null) {
        for ($i = 0; $i < count($request->student_id); $i++) {
            AssignStudent::where('year_id', $year_id)
                ->where('class_id', $class_id)
                ->where('student_id', $request->student_id[$i])
                ->update(['roll' => $request->roll[$i]]);
        }
    } else {
        return redirect()->back()->with('error', 'Sorry! There are no Student');
    }

    return redirect()->route('studentRollView')->with('success', 'Roll Generated Successfully!');
}
   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
