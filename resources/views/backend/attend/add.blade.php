@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

<style type="text/css">
    .switch-toggle {
        position: relative;
        display: inline-flex;
        background: #f8f9fa;
        border-radius: 50px;
        padding: 0px;
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    /* Animated particles inside toggle */
    .switch-toggle::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
        z-index: 1;
    }

    .switch-toggle:hover::before {
        transform: translateX(100%);
    }

    .switch-toggle input[type="radio"] {
        display: none;
    }

    .switch-toggle label {
        position: relative;
        display: block;
        padding: 12px 24px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        color: #140c25;
        transition: all 0.3s ease;
        border-radius: 46px;
        text-align: center;
        min-width: 80px;
        z-index: 2;
        user-select: none;
    }

    .switch-toggle label:hover {
        color: #495057;
        transform: translateY(-1px);
    }

    /* Sliding background indicator */
    .switch-toggle a {
        position: absolute;
        top: 4px;
        left: 4px;
        width: 80px;
        height: 40px;
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        border-radius: 46px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
        z-index: 1;
    }

    /* Present state */
    .switch-toggle input.present:checked~a {
        left: 4px;
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        box-shadow: 0 4px 20px rgba(79, 172, 254, 0.4);
    }

    .switch-toggle input.present:checked~label[for*="present"] {
        color: white;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }

    /* Add animated background for present state */
    .switch-toggle input.present:checked~a::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        border-radius: 46px;
        animation: presentPulse 2s infinite;
    }

    @keyframes presentPulse {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.8;
            transform: scale(1.05);
        }
    }

    /* Leave state */
    .switch-toggle input.leave:checked~a {
        left: 88px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        box-shadow: 0 4px 20px rgba(245, 87, 108, 0.4);
    }

    .switch-toggle input.leave:checked~label[for*="leave"] {
        color: white;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }

    /* Add animated background for leave state */
    .switch-toggle input.leave:checked~a::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border-radius: 46px;
        animation: leavePulse 2s infinite;
    }

    @keyframes leavePulse {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.8;
            transform: scale(1.05);
        }
    }

    /* Absent state */
    .switch-toggle input.absent:checked~a {
        left: 172px;
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        box-shadow: 0 4px 20px rgba(250, 112, 154, 0.4);
    }

    .switch-toggle input.absent:checked~label[for*="absent"] {
        color: white;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }

    /* Add animated background for absent state */
    .switch-toggle input.absent:checked~a::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        border-radius: 46px;
        animation: absentPulse 2s infinite;
    }

    @keyframes absentPulse {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.8;
            transform: scale(1.05);
        }
    }


    /* Glow effect on hover */
    .switch-toggle:hover {
        box-shadow:
            inset 0 2px 10px rgba(0, 0, 0, 0.1),
            0 0 20px rgba(79, 172, 254, 0.2);
    }

    /* Additional visual effects */
    .switch-toggle::after {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, transparent, rgba(79, 172, 254, 0.2), transparent);
        border-radius: 52px;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 0;
    }

    .switch-toggle:hover::after {
        opacity: 1;
    }

    /* Demo section */
    .demo-section {
        text-align: center;
        margin-bottom: 30px;
    }

    .demo-section h2 {
        color: #333;
        margin-bottom: 20px;
        font-size: 24px;
        text-shadow: none;
    }

    .demo-section p {
        color: #666;
        margin-bottom: 30px;
        font-size: 16px;
    }
</style>

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Employee Attendance</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Employee Attendance</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Employee Attendance</h1>
                    <a href="{{ route('employeeAttendView') }}" class="float-right btn btn-sm btn-success"> <i
                            class="fa fa-list"></i>
                        &nbsp;Attendance Lists</a>
                </div>
                <form method="POST" action="{{ route('employeeAttendStore') }}" id="userForm">
                    @csrf
                    <div class="card-body">

                        <div class="row">

                            <div class="form-group col-md-4">
                                <label class="control-label">Attendance Date</label>
                                <input type="date" name="date" id="date"
                                    class="checkdate form-control form-control-sm singledatepicker"
                                    placeholder="Attendance Date" autocomplete="off">
                            </div>

                            <table class="table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">SL.</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee Name
                                        </th>
                                        <th colspan="3" class="text-center" style="vertical-align: middle; width: 25%;">
                                            Attendance Status</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center btn present_all"
                                            style="display: table-cell; background-color: #114190;color:#ffffff">Present
                                        </th>
                                        <th class="text-center btn leave_all"
                                            style="display: table-cell; background-color: #114190;color:#ffffff">Leave</th>
                                        <th class="text-center btn absent_all"
                                            style="display: table-cell; background-color: #114190;color:#ffffff">Absent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $key => $employee)
                                        <tr id="div{{ $employee->id }}" class="text-center">
                                            <input type="hidden" name="employee_id[]" value="{{ $employee->id }}"
                                                class="employee_id">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td colspan="3">
                                                <div class="switch-toggle switch-3 switch-candy">
                                                    <input class="present" id="present{{ $key }}"
                                                        name="attend_status{{ $key }}" value="Present"
                                                        type="radio" checked="checked" />
                                                    <label for="present{{ $key }}">Present</label>

                                                    <input class="leave" id="leave{{ $key }}"
                                                        name="attend_status{{ $key }}" value="Leave"
                                                        type="radio" />
                                                    <label for="leave{{ $key }}">Leave</label>

                                                    <input class="absent" id="absent{{ $key }}"
                                                        name="attend_status{{ $key }}" value="Absent"
                                                        type="radio" />
                                                    <label for="absent{{ $key }}">Absent</label>
                                                    <a></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> <br> <br>
                        </div> <br>
                        <button type="submit" class="float-right btn btn-primary btn-sm">Save</button>
                    </div>

            </div>
            <!-- /.card-body -->


            </form>
        </div>
    </div>
    </div>
@endsection


@push('js')
    <script src="{{ asset('backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>







    <script type="text/javascript">
        $(document).on('click', '.present', function() {
            $(this).parents('tr').find('.datetime').css('pointer-events', 'none').css('background-color', '#dee2e6')
                .css('color', '#495057');
        });

        $(document).on('click', '.leave', function() {
            $(this).parents('tr').find('.datetime').css('pointer-events', '').css('background-color', 'white').css(
                'color', '#495057');
        });

        $(document).on('click', '.absent', function() {
            $(this).parents('tr').find('.datetime').css('pointer-events', 'none').css('background-color', '#dee2e6')
                .css('color', '#dee2e6');
        });
    </script>

    <script type="text/javascript">
        $(document).on('click', '.present_all', function() {
            $("input[value=Present]").prop('checked', true);
            $('.datetime').css('pointer-events', 'none').css('background-color', '#dee2e6').css('color', '#495057');
        });

        $(document).on('click', '.leave_all', function() {
            $("input[value=Leave]").prop('checked', true);
            $('.datetime').css('pointer-events', '').css('background-color', 'white').css('color', '#495057');
        });

        $(document).on('click', '.absent_all', function() {
            $("input[value=Absent]").prop('checked', true);
            $('.datetime').css('pointer-events', 'none').css('background-color', '#dee2e6').css('color', '#dee2e6');
        });
    </script>





    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#leave_purpose_id', function() {
                var leave_purpose_id = $(this).val();
                if (leave_purpose_id == '0') {
                    $('#add_others').show();
                } else {
                    $('#add_others').hide();
                }
            });
        });
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.custom-select').select2()

        });
    </script>






    <script>
        $(function() {
            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         alert("Form successful submitted!");
            //     }
            // });
            $('#userForm').validate({
                rules: {
                    date: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please Enter Group Name",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
