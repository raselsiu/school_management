<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AccountOtherCost;
use Illuminate\Http\Request;

class OtherCostController extends Controller
{
    public function view()
    {
        $data['allData'] = AccountOtherCost::orderBy('id', 'desc')->get();
        return view('backend.accounts.other_cost.view', $data);
    }

    public function add()
    {
        return view('backend.accounts.other_cost.add');
    }

    public function store(Request $request)
    {
        $cost = new AccountOtherCost();
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'), $filename);
            $cost['image'] = $filename;
        }
        $cost->description = $request->description;
        $cost->save();

        return redirect()->route('OthersCostview')->with('success', 'Data saved successfully!');
    }


    public function edit($id)
    {
        $data['editData'] = AccountOtherCost::find($id);
        return view('backend.accounts.other_cost.add', $data);
    }

    public function update(Request $request, $id)
    {
        $cost = AccountOtherCost::find($id);
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/cost_images/' . $cost->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'), $filename);
            $cost['image'] = $filename;
        }
        $cost->description = $request->description;
        $cost->save();

        return redirect()->route('OthersCostview')->with('success', 'Data updated successfully!');
    }
}
