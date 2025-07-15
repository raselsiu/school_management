<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee Details Info</title>
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
                <h4 style="font-weight: bold; ">Employee Details Info</h4>
            </div>
            <div class="col-md-12">
                <table border="1" width="80%" style="font-size: 12px;margin: 0 auto">
                    <tbody>
                        <tr>
                            <td style="width: 50%;">ID No.</td>
                            <td>{{ $details->id_no }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Employee Name</td>
                            <td>{{ $details->name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Fathers Name</td>
                            <td>{{ $details->fname }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Mothers Name</td>
                            <td>{{ $details->mname }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Mobile</td>
                            <td>{{ $details->mobile }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Address</td>
                            <td>{{ $details->address }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Gender</td>
                            <td>{{ $details->gender }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Religion</td>
                            <td>{{ $details->relegion }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Date of Birth</td>
                            <td>{{ date('d-m-Y', strtotime($details->dob)) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Designation</td>
                            <td>{{ $details['designation']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Join Date</td>
                            <td>{{ date('d-m-Y', strtotime($details->join_date)) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Salary</td>
                            <td>{{ $details->salary }} Tk</td>
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
