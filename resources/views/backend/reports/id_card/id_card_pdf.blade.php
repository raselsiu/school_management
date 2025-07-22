<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student ID Card</title>
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

        @foreach ($allData as $data)
            <div class="row" style="margin-bottom: 20px">
                <div class="col-md-3" style="border: 1px solid #000; margin: 0 110px 0px 110px">
                    <table border="0" width="100%">
                        <tbody>
                            <tr>
                                {{-- <td width="30%" style="padding: 10px;">
                                    <img src="{{ url('public/assets/backend/upload/abc_school.png') }}"
                                        style="height: 73px; width: 63px; border-radius: 5px;">
                                </td> --}}
                                <td width="40%" class="text-center">
                                    <p style="color: red; font-size: 20px; margin-bottom: 5px !important"><strong>ABC
                                            School</strong></p>
                                    <br />
                                    <p class="btn btn-primary" style="padding: 5px; font-size: 20px;">Student ID Card
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="45%" style="padding: 10px 3px 10px 5px;">
                                    <p style="font-size: 16px;"><strong>Name :</strong>{{ $data['student']['name'] }}
                                    </p>
                                </td>
                                <td width="10%" style="padding: 10px 3px 10px 5px;"></td>
                                <td width="45%" style="padding: 10px 3px 10px 5px;">
                                    <p style="font-size: 16px;"><strong>ID No :</strong>{{ $data['student']['id_no'] }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%" style="padding: 10px 3px 10px 5px;">
                                    <p style="font-size: 16px;"><strong>Session :</strong>{{ $data['year']['name'] }}
                                    </p>
                                </td>
                                <td width="20%" style="padding: 10px 3px 10px 5px;">
                                    <p style="font-size: 16px;"><strong>Class
                                            :</strong>{{ $data['studentClass']['name'] }}</p>
                                </td>
                                <td width="40%" style="padding: 10px 3px 10px 5px;">
                                    <p style="font-size: 16px;"><strong>Roll :</strong>{{ $data->roll }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td width="33%" style="padding: 15px 3px 5px 3px;"></td>
                                <td width="33%" style="padding: 15px 3px 5px 3px;"></td>
                                <td width="33%" style="padding: 15px 3px 5px 3px;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
