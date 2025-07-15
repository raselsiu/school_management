@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Employee</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">
                    Add Employee
                </li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">
                        Add Employee
                    </h1>
                    <a href="{{ route('employeeRegiView') }}" class="float-right btn btn-sm btn-success"> <i
                            class="fa fa-list"></i>
                        &nbsp;Employee Lists</a>
                </div>
                <form method="POST" action="{{ route('employeeRegiStore') }}" id="userForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="name">Employee Name<font style="color: red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name"
                                    placeholder="Enter Student Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Father's Name<font style="color: red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="fname" id="name"
                                    placeholder="Enter Student Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Mother's Name<font style="color: red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="mname" id="name"
                                    placeholder="Enter Student Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="mobile">Mobile<font style="color: red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="mobile" id="mobile"
                                    placeholder="Enter Student Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="address">Address<font style="color: red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="address" id="address"
                                    placeholder="Enter Student Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gender">Gender<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="gender" id="gender">
                                    <option value="">Select Option</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="religion">Religion<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="religion" id="religion">
                                    <option value="">Select Option</option>
                                    <option value="islam">Islam</option>
                                    <option value="hinduism">Hinduism</option>
                                    <option value="christian">Christian</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="religion">Date Of Birth<font style="color: red">*</font></label>
                                <input type="date" name="dob" class="form-control form-control-sm singledatepicker"
                                    autocomplete="off">
                            </div>


                            <div class="form-group col-md-4">
                                <label for="designation_id">Designation<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="designation_id" id="designation_id">
                                    <option value="">Select Designation</option>
                                    @foreach ($designaton as $desig)
                                        <option value="{{ $desig->id }}">{{ $desig->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="salary">Salary<font style="color: red">*</font></label>
                                <input type="text" class="form-control form-control-sm" name="salary" id="salary"
                                    placeholder="Employee Salary">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="religion">Joining Date<font style="color: red">*</font></label>
                                <input type="date" name="join_date"
                                    class="form-control form-control-sm singledatepicker" autocomplete="off">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="shift_id">Image</label>
                                <input type="file" name="image" id="image"
                                    class="form-control form-control-sm">
                            </div>

                            <div class="form-group col-md-3">
                                <img id="showImg" src="{{ asset('uploads/no_img.png') }}" alt="Preview Image"
                                    height="80px" width="100px">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ @$editData ? 'Update' : 'Save' }}</button>

                    </div>
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
                    name: {
                        required: true,
                    },
                    fname: {
                        required: true,
                    },
                    mname: {
                        required: true,
                    },
                    mobile: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    religion: {
                        required: true,
                    },
                    dob: {
                        required: true,
                    },
                    salary: {
                        required: true,
                    },
                    designation_id: {
                        required: true,
                    },
                    join_date: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Name Required!",
                    },
                    fname: {
                        required: "Father's Name Required!",
                    },
                    mname: {
                        required: "Mother's Name Required!",
                    },
                    mobile: {
                        required: "Enter Mobile Number",
                    },
                    address: {
                        required: "Address Required!",
                    },
                    gender: {
                        required: "Select Gender",
                    },
                    religion: {
                        required: "Select Relegion",
                    },
                    dob: {
                        required: "Date of Birth is Required!",
                    },
                    salary: {
                        required: "salary required!",
                    },
                    designation_id: {
                        required: "Designation required!",
                    },
                    join_date: {
                        required: "Joining Date required!",
                    },
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
