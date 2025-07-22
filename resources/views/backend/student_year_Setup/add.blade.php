@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Student Year Setup</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Year</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Add Year</h1>
                    <a href="{{ route('setupStudentYearView') }}" class="float-right btn btn-sm btn-success"> <i
                            class="fa fa-list"></i>
                        &nbsp;View Years</a>
                </div>
                <form method="POST" action="{{ route('setupStudentYearStore') }}" id="userForm">
                    @csrf
                    <div class="card-body">

                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="name">Year Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter Class Name">
                                @if ($errors->has('name'))
                                    <span style="color: red">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary">Save</button>

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
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please Enter Year Name",
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
