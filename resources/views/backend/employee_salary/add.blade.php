@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Employee Salary Increment</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Employee</li>
                <li class="breadcrumb-item active">Salary</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Employee Lists</h1>
                    <a href="{{ route('employeeSalaryView') }}" class="float-right btn btn-sm btn-success"> <i
                            class="fa fa-list"></i>
                        &nbsp;View Employee Lists</a>
                </div>
                <form method="POST" action="{{ route('employeeSalaryStore', $editData->id) }}" id="userForm">
                    @csrf
                    <div class="card-body">

                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="increment_salary">Salary Amount</label>
                                <input type="text" class="form-control" name="increment_salary" id="increment_salary"
                                    placeholder="Enter Incremented Salary">

                            </div>


                            <div class="form-group col-md-4">
                                <label for="effected_date">Effected Date</label>
                                <input type="date" class="form-control singledatepicker" name="effected_date"
                                    id="effected_date" placeholder="Enter Class Name">

                            </div>
                            <div class="form-group col-md-4" style="margin-top: 32px">
                                <button type="submit" class="btn btn-primary">Save</button>
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
                    increment_salary: {
                        required: true,
                    },
                    effected_date: {
                        required: true,
                    },
                },
                messages: {
                    increment_salary: {
                        required: "Please enter salary amount",
                    },
                    effected_date: {
                        required: "Enter effected date",
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
