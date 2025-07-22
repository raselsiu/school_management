<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee Monthly Salary</title>
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
        @php
            $date = date('Y-m', strtotime($totalattendgroupbyid['0']->date));
            if ($date != '') {
                $where[] = ['date', 'like', $date . '%'];
            }
            $totalattend = App\Models\EmployeeAttendance::with(['user'])
                ->where($where)
                ->where('employee_id', $totalattendgroupbyid['0']->employee_id)
                ->get();
            $singleSalary = (float) $totalattendgroupbyid['0']['user']['salary'];
            $salaryperday = (float) $singleSalary / 30;
            $absentcount = count($totalattend->where('attend_status', 'Absent'));
            $totalsalaryminus = (int) $absentcount * (float) $salaryperday;
            $totalsalary = (int) $singleSalary - (int) $totalsalaryminus;
        @endphp
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
                <h4 style="font-weight: bold; ">Employee Monthly Salary</h4>
            </div>
            <div class="col-md-12">
                <table border="1" width="80%" style="font-size: 12px;margin: 0 auto">
                    <tbody>
                        <tr>
                            <td style="width: 50%">Employee Name</td>
                            <td>{{ $totalattendgroupbyid['0']['user']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Basic Salary</td>
                            <td>{{ $totalattendgroupbyid['0']['user']['salary'] }}</td>
                        </tr>
                        <tr>
                            <td>Total absent for this month</td>
                            <td>{{ $absentcount }}</td>
                        </tr>
                        <tr>
                            <td>Month</td>
                            <td>{{ date('M Y', strtotime($totalattendgroupbyid['0']->date)) }}</td>
                        </tr>
                        <tr>
                            <td>Salary for this Month</td>
                            <td>{{ $totalsalary }}</td>
                        </tr>
                    </tbody>
                </table>
                <i style="font-size: 10px;padding-top:5px;margin-left: 10%">Print Date: {{ date('d M Y') }}</i>
            </div><br>
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
        <hr style="color: #d8d8d8">
        <div class="row">
            <div class="col-md-12">
                <table width="100%">

                    <tr>
                        <td class="text-center" width="100%">
                            <h3 style="margin: 0"><strong>{{ $schoolNameEN }}</strong></h3>
                            <h6 style="margin-top:8px;margin-bottom: 8px;"><strong>{{ $addressEN }}</strong></h6>
                            <h5 style="margin: 0"><strong>{{ $website }}</strong></h5>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h4 style="font-weight: bold; ">Employee Monthly Salary</h4>
            </div>
            <div class="col-md-12">
                <table border="1" width="80%" style="font-size: 12px;margin: 0 auto">
                    <tbody>
                        <tr>
                            <td style="width: 50%">Employee Name</td>
                            <td>{{ $totalattendgroupbyid['0']['user']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Basic Salary</td>
                            <td>{{ $totalattendgroupbyid['0']['user']['salary'] }}</td>
                        </tr>
                        <tr>
                            <td>Total absent for this month</td>
                            <td>{{ $absentcount }}</td>
                        </tr>
                        <tr>
                            <td>Month</td>
                            <td>{{ date('M Y', strtotime($totalattendgroupbyid['0']->date)) }}</td>
                        </tr>
                        <tr>
                            <td>Salary for this Month</td>
                            <td>{{ $totalsalary }}</td>
                        </tr>
                    </tbody>
                </table>
                <i style="font-size: 10px;padding-top:5px;margin-left: 10%">Print Date: {{ date('d M Y') }}</i>
            </div><br>
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
