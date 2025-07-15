@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Employee Leave</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Employee Leave</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Employee Leave</h1>
                    <a href="{{ route('employeeLeaveView') }}" class="float-right btn btn-sm btn-success"> <i
                            class="fa fa-list"></i>
                        &nbsp;View All Group</a>
                </div>
                <form method="POST" action="{{ route('employeeLeaveStore') }}" id="userForm">
                    @csrf
                    <div class="card-body">

                        <div class="row">


                            <div class="form-group col-md-4">
                                <label for="employee_id">Employee<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="employee_id" id="employee_id">
                                    <option value="">Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Start Date</label>
                                <input type="date" name="start_date"
                                    class="form-control form-control-sm singledatepicker" placeholder="Start Date">
                            </div>
                            <div class="form-group col-md-4">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control form-control-sm singledatepicker"
                                    placeholder="End Date">
                            </div>

                            <div class="form-group col-md-8">
                                <label for="leave_purpose_id">Leave Purpose<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="leave_purpose_id" id="leave_purpose_id">
                                    <option value="">Select Purpose</option>
                                    @foreach ($leave_purpose as $purpose)
                                        <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                                    @endforeach
                                    <option value="0">Create New Purpose</option>
                                </select>
                                <input type="text" name="name" class="form-control form-control-sm"
                                    placeholder="Write Purpose" id="add_others" style="display: none">
                            </div>

                            <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>

                        </div>





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
                    name: {
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
