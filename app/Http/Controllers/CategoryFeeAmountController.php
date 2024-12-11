<?php

namespace App\Http\Controllers;

use App\Models\CategoryFeeAmount;
use App\Models\StudentClassSetup;
use App\Models\StudentFeeSetup;
use Illuminate\Http\Request;

class CategoryFeeAmountController extends Controller
{
    public function view()
    {
        $data['allData'] = CategoryFeeAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setups.category_fee_amount.index', $data);
    }

    public function add()
    {
        $data['fee_category'] = StudentFeeSetup::all();
        $data['classes'] = StudentClassSetup::all();
        return view('backend.setups.category_fee_amount.add', $data);
    }


    public function store(Request $request)
    {


        $request->validate([
            'amount.*' => 'required|numeric|min:0',
        ]);



        $hasClass = count($request->class_id);
        if ($hasClass != null) {
            $classes_id = $request->input('class_id');   // This will be an array of classes_id
            $amounts = $request->input('amount');  // This will be an array of amounts

            foreach ($classes_id as $index => $class_id) {
                $amount = $amounts[$index];

                CategoryFeeAmount::create([
                    'fee_category_id' => $request->fee_category_id,
                    'class_id' => $class_id,
                    'amount' => $amount,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data saved successfully!');


        // $data = new CategoryFeeAmount();
        // $data->name = $request->name;
        // $data->save();

        // return redirect()->route('studentFeeCategoryAmountView')->with('success', 'Fee Category Created Successfully');
    }

    public function edit(string $fee_category_id)
    {
        $data['editData'] = CategoryFeeAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();
        $data['fee_category'] = StudentFeeSetup::all();
        $data['classes'] = StudentClassSetup::all();
        return view('backend.setups.category_fee_amount.edit', $data);
    }


    public function show(string $fee_category_id)
    {
        $data['editData'] = CategoryFeeAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();

        return view('backend.setups.category_fee_amount.show', $data);
    }


    public function update(Request $request, string $fee_category_id)
    {

        if ($request->class_id == null) {
            return redirect()->back()->with('error', 'Something Wrong');
        } else {

            $request->validate([
                'amount.*' => 'required|numeric|min:0',
            ]);



            CategoryFeeAmount::where('fee_category_id', $fee_category_id)->delete();

            $classes_id = $request->input('class_id');
            $amounts = $request->input('amount');

            foreach ($classes_id as $index => $class_id) {
                $amount = $amounts[$index];

                CategoryFeeAmount::create([
                    'fee_category_id' => $request->fee_category_id,
                    'class_id' => $class_id,
                    'amount' => $amount,
                ]);
            }
        }

        return redirect()->route('studentFeeCategoryAmountView')->with('success', 'Fee Category Amount Updated Successfully');
    }


    public function delete(string $id)
    {
        $data = CategoryFeeAmount::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Fee Category Deleted Successfully');
    }
}
