<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Result</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <style type="text/css">
        /* Enhanced CSS for beautiful print-ready tables */

        /* Print-specific styles */
        @media print {

            /* Ensure table fits on page */
            .table {
                font-size: 11px;
                line-height: 1.2;
                page-break-inside: avoid;
            }

            /* Prevent table headers from breaking across pages */
            .table thead {
                display: table-header-group;
            }

            /* Prevent table rows from breaking across pages */
            .table tr {
                page-break-inside: avoid;
            }

            /* Remove any background colors for better print contrast */
            .table-bordered thead th {
                background-color: #f8f9fa !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }

        /* Base table styles */
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2,
        h4,
        h6 {
            margin: 0;
            padding: 0;
        }

        .table {
            width: 100%;
            margin-bottom: 1.5rem;
            background-color: transparent;
            font-size: 13px;
            line-height: 1.4;
        }

        .table th,
        .table td {
            padding: 8px 12px;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
            text-align: left;
        }

        /* Enhanced header styling */
        .table thead th {
            vertical-align: middle;
            border-bottom: 2px solid #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            color: #495057;
            background-color: #f8f9fa;
            position: relative;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        /* Enhanced bordered table */
        .table-bordered {
            border: 2px solid #495057;
            border-radius: 4px;
            overflow: hidden;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #d1d3d4;
        }

        .table-bordered thead th {
            border-bottom: 2px solid #495057;
            background-color: #f8f9fa;
        }

        /* Alternating row colors for better readability */
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        /* Text alignment utilities */
        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-left {
            text-align: left !important;
        }

        /* Enhanced cell padding */
        table tr td {
            padding: 8px 12px;
        }

        /* Improved header styling */
        .table-bordered thead th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 1px solid #adb5bd !important;
            font-weight: 700;
            color: #343a40;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #d1d3d4 !important;
        }

        /* Additional enhancements */
        .table-responsive {
            overflow-x: auto;
        }

        /* Number formatting for better readability */
        .table .number {
            font-family: 'Courier New', monospace;
            text-align: right;
        }

        /* Status indicators */
        .table .status-active {
            color: #28a745;
            font-weight: 600;
        }

        .table .status-inactive {
            color: #dc3545;
            font-weight: 600;
        }

        .table .status-pending {
            color: #ffc107;
            font-weight: 600;
        }

        /* Compact table variant */
        .table-sm th,
        .table-sm td {
            padding: 4px 8px;
            font-size: 12px;
        }

        /* Professional shadows and borders */
        .table-professional {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 6px;
            overflow: hidden;
        }

        .table-professional thead th {
            background: linear-gradient(135deg, #495057 0%, #343a40 100%);
            color: white;
            border: none;
            text-shadow: none;
        }

        .table-professional tbody tr {
            border-bottom: 1px solid #e9ecef;
        }

        .table-professional tbody tr:last-child {
            border-bottom: none;
        }

        /* Print optimization */
        @page {
            margin: 0.5in;
            size: auto;
        }

        @media print {
            body {
                font-size: 12pt;
                line-height: 1.3;
            }

            .table {
                font-size: 10pt;
                border-collapse: collapse !important;
            }

            .table th,
            .table td {
                padding: 6px 8px !important;
            }

            /* Ensure borders print correctly */
            .table-bordered th,
            .table-bordered td {
                border: 1pt solid #000 !important;
            }

            .table-bordered thead th {
                background-color: #e9ecef !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
            }

            /* Remove hover effects in print */
            .table tbody tr:hover {
                background-color: transparent !important;
            }
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
                            <h3 style="margin: 0"><strong>{{ $schoolNameEN }}</strong></h3>
                            <h6 style="margin-top:8px;margin-bottom: 8px;"><strong>{{ $addressEN }}</strong></h6>
                            <h5 style="margin: 0"><strong>{{ $website }}</strong></h5>
                        </td>
                    </tr>
                </table>
            </div> <br>
            <div class="col-md-12 text-center">
                <h4 style="font-weight: bold; ">Result of {{ @$allData[0]['exam_type']['name'] }}</h4>
            </div> <br>
            <div class="col-md-12">
                <table border="0" width="100%" cellpadding="1" cellspacing="2" class="text-center">
                    <tbody>
                        <tr>
                            <td><strong>Year / Session : &nbsp;</strong>{{ @$allData[0]['year']['name'] }}</td>
                            <td></td>
                            <td></td>
                            <td><strong>Class:&nbsp;</strong>{{ @$allData[0]['student_class']['name'] }}</td>
                        </tr>
                    </tbody>
                </table>

                <br>

            </div>

            <br>
            <div class="col-md-12">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th width="5%">S/L</th>
                            <th>Student Name</th>
                            <th>ID No</th>
                            <th width="15%">Letter Grade</th>
                            <th width="15%">Greade Point</th>
                            <th width="15%">Remarks</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center">
                        @foreach ($allData as $key => $data)
                            @php
                                $allMarks = App\Models\StudentMarks::where('year_id', $data->year_id)
                                    ->where('class_id', $data->class_id)
                                    ->where('exam_type_id', $data->exam_type_id)
                                    ->where('student_id', $data->student_id)
                                    ->get();
                                $total_marks = 0;
                                $total_point = 0;
                                foreach ($allMarks as $value) {
                                    $count_fail = App\Models\StudentMarks::where('year_id', $value->year_id)
                                        ->where('class_id', $value->class_id)
                                        ->where('exam_type_id', $value->exam_type_id)
                                        ->where('student_id', $value->student_id)
                                        ->where('marks', '<', '33')
                                        ->get()
                                        ->count();
                                    $get_mark = $value->marks;
                                    $grade_marks = App\Models\MarksGrade::where([
                                        ['start_marks', '<=', (int) $get_mark],
                                        ['end_marks', '>=', (int) $get_mark],
                                    ])->first();
                                    $grade_name = $grade_marks->grade_name;
                                    $grade_point = number_format((float) $grade_marks->grade_point, 2);
                                    $total_point = (float) $total_point + (float) $grade_point;
                                }
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data['student']['name'] }}</td>
                                <td>{{ $data['student']['id_no'] }}</td>
                                @php
                                    $total_subject = App\Models\StudentMarks::where('year_id', $data->year_id)
                                        ->where('class_id', $data->class_id)
                                        ->where('exam_type_id', $data->exam_type_id)
                                        ->where('student_id', $data->student_id)
                                        ->get()
                                        ->count();
                                    $total_grade = 0;
                                    $point_for_letter_grade = (float) $total_point / (float) $total_subject;
                                    $total_grade = App\Models\MarksGrade::where([
                                        ['start_point', '<=', $point_for_letter_grade],
                                        ['end_point', '>=', $point_for_letter_grade],
                                    ])->first();
                                    $grade_point_avg = (float) $total_point / (float) $total_subject;
                                @endphp
                                <td>
                                    @if ($count_fail > 0)
                                        F
                                    @else
                                        {{ $total_grade->grade_name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($count_fail > 0)
                                        0.00
                                    @else
                                        {{ number_format((float) $grade_point_avg, 2) }}
                                    @endif
                                </td>
                                <td>
                                    @if ($count_fail > 0)
                                        Fail
                                    @else
                                        {{ $total_grade->remarks }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <i style="font-size: 10px;padding-top:5px;">Print Date: {{ date('d M Y') }}</i>
            </div>
            <br> <br>
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
