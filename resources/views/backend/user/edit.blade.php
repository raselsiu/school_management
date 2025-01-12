@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>User Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Edit User</h1>
                    <a href="{{ route('backUsersView') }}" class="float-right btn btn-sm btn-success"> <i
                            class="fa fa-list"></i>
                        &nbsp;View Users</a>
                </div>
                <form method="post" action="{{ route('backUsersUpdate', $user->id) }}" id="userForm">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="user_role">User Role</label>
                                <select class="custom-select rounded-0" name="role" id="role">
                                    <option value="">Select Role</option>
                                    <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Operator" {{ $user->role == 'Operator' ? 'selected' : '' }}>Operator</option>
                                </select>
                                @if ($errors->has('role'))
                                    <span style="color: red">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" name="name"
                                    id="name" placeholder="Enter name">
                                @if ($errors->has('name'))
                                    <span style="color: red">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" id="email"
                                    name="email" placeholder="Enter email">
                                @if ($errors->has('email'))
                                    <span style="color: red">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">

                            {{-- <div class="form-group col-md-4">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div> --}}
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
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>

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
                        maxlength: 50,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    role: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "Please enter name",
                        maxlength: "Your password must be not greater then 50 characters long"
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a valid email address"
                    },
                    role: {
                        required: "Please enter user role",
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
