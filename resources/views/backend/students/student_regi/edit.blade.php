@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Student</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">
                    Edit Student
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
                            Edit Student
                    </h1>
                    <a href="{{ route('studentRegiView') }}" class="float-right btn btn-sm btn-success"> <i
                            class="fa fa-list"></i>
                        &nbsp;Student Lists</a>
                </div>
                <form method="POST" action="{{ route('studentRegiUpdate',$editData->student_id)}}" id="userForm" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $editData->id }}">

                    <div class="card-body">

                        <div class="row">

                            <div class="form-group col-md-4">
                                <label for="name">Student Name<font style="color: red">*</font></label>
                                <input type="text" class="form-control form-control-sm" value="{{ @$editData['student']['name'] }}" name="name" id="name"
                                    placeholder="Enter Student Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Father's Name<font style="color: red">*</font></label>
                                <input type="text" class="form-control form-control-sm" value="{{ @$editData['student']['fname'] }}" name="fname" id="name"
                                    placeholder="Enter Student Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Mother's Name<font style="color: red">*</font></label>
                                <input type="text" class="form-control form-control-sm" value="{{ @$editData['student']['mname'] }}" name="mname" id="name"
                                    placeholder="Enter Student Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="mobile">Mobile<font style="color: red">*</font></label>
                                <input type="text" class="form-control form-control-sm" value="{{ @$editData['student']['mobile'] }}" name="mobile" id="mobile"
                                    placeholder="Enter Student Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="address">Address<font style="color: red">*</font></label>
                                <input type="text" class="form-control form-control-sm" value="{{ @$editData['student']['address'] }}" name="address" id="address"
                                    placeholder="Enter Student Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gender">Gender<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="gender" id="gender">
                                    <option value="">Select Option</option>
                                    <option value="male" {{  @$editData['student']['gender'] ==  'male' ? 'selected' : ''   }}>Male</option>
                                    <option value="female" {{ @$editData['student']['gender'] ==  'female' ? 'selected' : ''  }} >Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="religion">Religion<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="religion" id="religion">
                                    <option value="">Select Option</option>
                                    <option value="islam" {{ @$editData['student']['relegion'] ==  'islam' ? 'selected' : ''  }}>Islam</option>
                                    <option value="hinduism" {{ @$editData['student']['relegion'] ==  'hinduism' ? 'selected' : ''  }}>Hinduism</option>
                                    <option value="christian" {{ @$editData['student']['relegion'] ==  'christian' ? 'selected' : ''  }}>Christian</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="religion">Date Of Birth<font style="color: red">*</font></label>
                                <input type="date" name="dob" placeholder="" value="{{ @$editData['student']['dob'] }}"
                                    class="form-control form-control-sm singledatepicker" autocomplete="off">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="discount">Discount</label>
                                <input type="number" name="discount" value="{{ @$editData['discount']['discount'] }}" placeholder="Enter Discount"
                                    class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="year_id">Year<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="year_id" id="year_id">
                                    <option value="">Select Year</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}" {{ @$editData->year_id == $year->id ? 'selected' : '' }}>{{ $year->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="class_id">Class<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="class_id" id="class_id">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ @$editData->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="group_id">Group</label>
                                <select class="form-control form-control-sm" name="group_id" id="group_id">
                                    <option value="">Select Group</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}" {{ @$editData->group_id == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="shift_id">Shift</label>
                                <select class="form-control form-control-sm" name="shift_id" id="shift_id">
                                    <option value="">Select Shift</option>
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}" {{ @$editData->shift_id == $shift->id ? 'selected' : '' }}>{{ $shift->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="shift_id">Image</label>
                                <input type="file" name="image" id="image"
                                    class="form-control form-control-sm">
                            </div>
                            <div class="form-group col-md-4">
                                <img id="showImg" src="{{ !empty($editData['student']['image']) ? url('/upload/student_image/' . $editData['student']['image']) : asset('uploads/no_img.png') }}" alt="Preview Image"
                                    height="80px" width="100px">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

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
                    year_id: {
                        required: true,
                    },
                    class_id: {
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
                    year_id: {
                        required: "Select Year!",
                    },
                    class_id: {
                        required: "Select Class!",
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
