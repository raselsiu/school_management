<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\AccountStudentFee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProfitReportController extends Controller
{
    public function view()
    {
        return view('backend.reports.monthly_profit.view');
    }

    public function getProfit(Request $request)
    {
        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $total_cost = $other_cost + $emp_salary;
        $profit = $student_fee - $total_cost;

        $html['thsource']  = '<th>Students Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit</th>';
        $html['thsource'] .= '<th>Action</th>';
        $color = 'success';
        $html['tdsource']  = '<td>' . $student_fee . '</td>';
        $html['tdsource'] .= '<td>' . $other_cost . '</td>';
        $html['tdsource'] .= '<td>' . $emp_salary . '</td>';
        $html['tdsource'] .= '<td>' . $total_cost . '</td>';
        $html['tdsource'] .= '<td>' . $profit . '</td>';
        $html['tdsource'] .= '<td>' . '<a class="btn btn-sm btn-' . $color . '" title="PDF" target="_blank" href="' . route('reportsProfitGeneratePdf') . '?start_date=' . $sdate . '&end_date=' . $edate . '"><i class="fa fa-file"></i></a>' . '</td>';;
        $html['tdsource'] .= '</td>';

        return response()->json(@$html);
    }

    public function pdf(Request $request)
    {


        $data['sdate'] = date('Y-m', strtotime($request->start_date));
        $data['edate'] = date('Y-m', strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));
        $pdf = Pdf::loadView('backend.reports.monthly_profit.pdf', $data);
        return $pdf->stream('document.pdf');
    }
}
