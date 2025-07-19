<!DOCTYPE html>
<html lang="en">

<head>
    <title>Monthly / Yearly Profit</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <style type="text/css">
        table {
            border-collapse: collapse;
        }

        h2 h4 h6 {
            margin: 0;
            padding: 0;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table .table {
            background-color: #fff;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table tr td {
            padding: 5px;
        }

        .table-bordered thead th,
        .table-bordered td,
        .table-bordered th {
            border: 1px solid black !important;
        }

        .table-bordered thead th {
            background-color: #cacaca;
        }
    </style>
</head>


<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table width="100%">

                    <tr>
                        <td class="text-center" width="100%">
                            <h3 style="margin: 0"><strong>Brahmanbaria Residential School & College</strong></h3>
                            <h4 style="margin-top:8px;margin-bottom: 8px;"><strong>Brahmanbaria Sadar,
                                    Brahmanbaria</strong>
                            </h4>
                            <h5 style="margin: 0"><strong>www.school.dcsdevs.com</strong></h5>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h4 style="font-weight: bold; ">Monthly / Yearly Profit</h4>
            </div>
            <div class="col-md-12">
                @php
                    use App\Models\AccountEmployeeSalary;
                    use App\Models\AccountOtherCost;
                    use App\Models\AccountStudentFee;

                    $student_fee = AccountStudentFee::whereBetween('date', [$sdate, $edate])->sum('amount');
                    $other_cost = AccountOtherCost::whereBetween('date', [$start_date, $end_date])->sum('amount');
                    $emp_salary = AccountEmployeeSalary::whereBetween('date', [$sdate, $edate])->sum('amount');
                    $total_cost = $other_cost + $emp_salary;
                    $profit = $student_fee - $total_cost;

                @endphp
                <table border="1" width="80%" style="font-size: 12px;margin: 0 auto">
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <strong>
                                    Reporting Date: {{ date('d M Y', strtotime($start_date)) }} -
                                    {{ date('d M Y', strtotime($end_date)) }}
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%">
                                <strong>Purpose</strong>
                            </td>
                            <td>
                                <strong>Amount</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>Students Fee</td>
                            <td>{{ $student_fee }} TK</td>
                        </tr>
                        <tr>
                            <td>Employee Salary</td>
                            <td>{{ number_format($emp_salary, 2, '.') }} TK</td>
                        </tr>
                        <tr>
                            <td>Other Cost</td>
                            <td>{{ $other_cost }} TK</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">
                                Total Cost
                            </td>
                            <td>
                                {{ number_format($total_cost, 2, '.') }} TK
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%">
                                Profit
                            </td>
                            <td>
                                {{ number_format($profit, 2, '.') }} TK
                            </td>
                        </tr>
                    </tbody>
                </table>
                <i style="font-size: 10px;padding-top:5px;margin-left: 10%">Print Date: {{ date('d M Y') }}</i>
            </div>
            <br>
            <div class="col-md-12">
                <table border="0" width="100%">
                    <tbody>
                        <tr>
                            <td style="width: 30%"></td>
                            <td style="width: 40%; text-align: center;">
                                <hr style="border: solid 1px; width: 60%; color: #000; margin-bottom: 0px;">
                                <p style="text-align: center;">Principal/Headmaster</p>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
