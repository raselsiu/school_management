<?php

namespace App\Http\Controllers\Backend\Students;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClassSetup;
use App\Models\StudentGroupSetup;
use App\Models\StudentShiftSetup;
use App\Models\StudentYearSetup;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StudentRegiController extends Controller
{



    public function promotion($student_id)
    {

        $data['editData'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        $data['years'] = StudentYearSetup::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClassSetup::all();
        $data['groups'] = StudentGroupSetup::all();
        $data['shifts'] = StudentShiftSetup::all();

        return view('backend.students.student_regi.promotion', $data);
    }

    public function promotionStore(Request $request, string $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {
            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->usertype = 'student';
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->relegion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            // Image insertion

            $folderPath = public_path('upload/student_image');

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_image/' . $user->image));
                $fileName = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_image'), $fileName);
                $user->image = $fileName;
            }

            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        return redirect()->route('studentRegiView')->with('success', 'Student Promotion Success!');
    }




    public function searchYearClass(Request $request)
    {

        @$data['years'] = StudentYearSetup::orderBy('id', 'desc')->get();
        @$data['classes'] = StudentClassSetup::all();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['allData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();

        return view("backend.students.student_regi.view", $data);
    }


    /**
     * Display a listing of the resource.
     */

    public function view()
    {

        @$data['years'] = StudentYearSetup::orderBy('id', 'desc')->get();
        @$data['classes'] = StudentClassSetup::all();

        @$data['year_id'] = StudentYearSetup::orderBy('id', 'asc')->first()->id;
        @$data['class_id'] = StudentClassSetup::orderBy('id', 'asc')->first()->id;

        $data['allData'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();

        return view("backend.students.student_regi.view", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {

        $data['years'] = StudentYearSetup::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClassSetup::all();
        $data['groups'] = StudentGroupSetup::all();
        $data['shifts'] = StudentShiftSetup::all();

        return view('backend.students.student_regi.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $checkYear = StudentYearSetup::find($request->year_id)->name;
            $student = User::where('usertype', 'student')->orderBy('id', 'desc')->first();
            if ($student == null) {
                $firstreg = 0;
                $studentId = $firstreg + 1;
                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } elseif ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } elseif ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }
            } else {
                $student = User::where('usertype', 'student')->orderBy('id', 'desc')->first()->id;
                $studentId = $student + 1;
                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } elseif ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } elseif ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }
            }
            $final_id_no = $checkYear . $id_no;

            $user = new User();
            $code = rand(0000, 9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->name = $request->name;
            $user->usertype = 'student';
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->relegion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            // Image insertion

            $folderPath = public_path('upload/student_image');

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }

            if ($request->file('image')) {
                $file = $request->file('image');
                $fileName = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_image'), $fileName);
                $user->image = $fileName;
            }

            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->class_id = $request->class_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        return redirect()->route('studentRegiView')->with('success', 'Data Saved Successfully!');
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
    public function edit(string $student_id)
    {

        $data['editData'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        $data['years'] = StudentYearSetup::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClassSetup::all();
        $data['groups'] = StudentGroupSetup::all();
        $data['shifts'] = StudentShiftSetup::all();

        return view('backend.students.student_regi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {
            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->usertype = 'student';
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->relegion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            // Image insertion

            $folderPath = public_path('upload/student_image');

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_image/' . $user->image));
                $fileName = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_image'), $fileName);
                $user->image = $fileName;
            }

            $user->save();

            $assign_student = AssignStudent::where('id', $request->id)->where('student_id', $student_id)->first();
            $assign_student->class_id = $request->class_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id', $request->id)->first();
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        return redirect()->route('studentRegiView')->with('success', 'Data Updated Successfully!');
    }


    public function studentDetails(string $student_id)
    {

        $data['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();

        $pdf = Pdf::loadView('backend.students.student_regi.details', $data);
        return $pdf->stream('details.pdf');
    }
}
