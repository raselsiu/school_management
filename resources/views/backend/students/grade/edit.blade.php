@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Grade Point</h1>
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
                    <h1 class="card-title">Grade Point</h1>
                    <a href="{{ route('gradePointView') }}" class="float-right btn btn-sm btn-success"> <i
                            class="fa fa-list"></i>
                        &nbsp;Grade Point Lists</a>
                </div>
                <form method="POST" action="{{ route('gradePointUpdate', $editData->id) }}" id="userForm">
                    @csrf
                    <div class="form-group col-md-4">
                        <label>Grade Name</label>
                        <input type="text" name="grade_name" class="form-control" value="{{ $editData->grade_name }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Grade Point</label>
                        <input type="text" name="grade_point" class="form-control" value="{{ $editData->grade_point }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Start Marks</label>
                        <input type="text" name="start_marks" class="form-control" value="{{ $editData->start_marks }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>End Marks</label>
                        <input type="text" name="end_marks" class="form-control" value="{{ $editData->end_marks }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Start Point</label>
                        <input type="text" name="start_point" class="form-control" value="{{ $editData->start_point }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>End Point</label>
                        <input type="text" name="end_point"class="form-control" value="{{ $editData->end_point }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control" value="{{ $editData->remarks }}">
                    </div>
                    <div class="form-group col-md-4" style="padding-top: 30px;">
                        <button type="submit" class="btn btn-success">Update Now</button>
                    </div>
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

            $('#userForm').validate({
                rules: {
                    grade_name: {
                        required: true,
                    },
                    grade_point: {
                        required: true,
                    },
                    start_marks: {
                        required: true,
                    },
                    end_marks: {
                        required: true,
                    },
                    start_point: {
                        required: true,
                    },
                    end_point: {
                        required: true,
                    },
                    remarks: {
                        required: true,
                    }
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
