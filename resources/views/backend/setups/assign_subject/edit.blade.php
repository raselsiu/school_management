@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Assign Subject</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Assign Subject</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Edit Assign Subject</h1>
                    <a href="{{ route('assignSubjectView') }}" class="float-right btn btn-sm btn-success"> <i
                            class="fa fa-list"></i>
                        &nbsp;View All Assign Subject</a>

                </div>
                <form method="POST" action="{{ route('assignSubjectUpdate', $editData['0']->class_id) }}" id="userForm">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Class</label>
                                <select class="custom-select" name="class_id" id="class_id">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ $editData['0']->class_id == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class_id'))
                                    <span style="color: red">Select Class</span>
                                @endif
                            </div>
                        </div>


                        @foreach ($editData as $edit)
                            <div id="fieldsContainer">
                                <div class="fieldRow">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Subject</label>
                                            <select class="custom-select" name="subject_id[]" id="subject_id">
                                                <option value="">Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}"
                                                        {{ $edit->subject_id == $subject->id ? 'selected' : '' }}>
                                                        {{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('subject_id'))
                                                <span style="color: red">Select Subject</span>
                                            @endif
                                        </div>


                                        <div class="form-group col-md-2">
                                            <label for="name">Full Mark</label>
                                            <input type="number" class="form-control" name="full_mark[]"
                                                value="{{ $edit->full_mark }}" id="full_mark" placeholder="Full Marks">
                                            @if ($errors->has('full_mark'))
                                                <span style="color: red">{{ $errors->first('full_mark') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="name">Pass Mark</label>
                                            <input type="number" class="form-control" name="pass_mark[]"
                                                value="{{ $edit->pass_mark }}" id="pass_mark" placeholder="Pass Marks">
                                            @if ($errors->has('pass_mark'))
                                                <span style="color: red">{{ $errors->first('pass_mark') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="name">Mark Obtained</label>
                                            <input type="number" class="form-control" name="get_mark[]"
                                                value="{{ $edit->get_mark }}" id="get_mark" placeholder="Mark Obtained">
                                            @if ($errors->has('get_mark'))
                                                <span style="color: red">{{ $errors->first('get_mark') }}</span>
                                            @endif
                                        </div>


                                        <div class="form-group col-md-2">
                                            <button type="button" class="addFieldBtn btn btn-success">+</button>
                                            <button type="button" class="removeFieldBtn btn btn-danger">-</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection


@push('js')
    <script>
        $(document).ready(function() {
            // Add new row of fields
            $(document).on('click', '.addFieldBtn', function() {
                let newRow = `
                 <div class="fieldRow" id="userForm">
                                <div class="row">
                                <div class="form-group col-md-3">
                                        <label>Subject</label>
                                        <select class="custom-select" name="subject_id[]" id="subject_id" required>
                                            <option value="">Select Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('subject_id'))
                                            <span style="color: red">Select a subject</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="name">Full Mark</label>
                                        <input type="number" class="form-control" value="" name="full_mark[]" id="full_mark"
                                            placeholder="Full Marks" required>
                                        @if ($errors->has('full_mark'))
                                            <span style="color: red">{{ $errors->first('full_mark') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="name">Pass Mark</label>
                                        <input type="number" class="form-control" value="" name="pass_mark[]" id="pass_mark"
                                            placeholder="Pass Marks" required>
                                        @if ($errors->has('pass_mark'))
                                            <span style="color: red">{{ $errors->first('pass_mark') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="name">Marks Obtained</label>
                                        <input type="number" class="form-control" value="" name="get_mark[]" id="get_mark"
                                            placeholder="Marks Obtained" required>
                                        @if ($errors->has('get_mark'))
                                            <span style="color: red">{{ $errors->first('get_mark') }}</span>
                                        @endif
                                    </div>


                                    <div class="form-group col-md-2">
                                        <button type="button" class="addFieldBtn btn btn-success">+</button>
                                        <button type="button" class="removeFieldBtn btn btn-danger">-</button>
                                    </div>
                                </div>
                            </div>
        `;
                $('#fieldsContainer').prepend(newRow);

                // Show the remove button for all rows except the first one
                $('.removeFieldBtn').show();
            });

            // Remove row of fields
            $(document).on('click', '.removeFieldBtn', function() {
                $(this).closest('.fieldRow').remove();

                // If there's only one row left, hide the minus button
                if ($('#fieldsContainer .fieldRow').length === 1) {
                    $('.removeFieldBtn').hide();
                }
            });

            // Initially hide the minus button if there's only one row
            if ($('#fieldsContainer .fieldRow').length === 1) {
                $('.removeFieldBtn').hide();
            }
        });
    </script>






    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>




    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.custom-select').select2(),
                $('.customs').select2()

        });
    </script>


    <script>
        $(function() {
            $('#userForm').validate({
                rules: {
                    "class_id": {
                        required: true,
                    },

                    "subject_id[]": {
                        required: true,
                    },

                    "full_mark[]": {
                        required: true,
                    },
                    "pass_mark[]": {
                        required: true,
                    },
                    "get_mark[]": {
                        required: true,
                    },
                },
                messages: {
                    class_id: {
                        required: "Class Required",
                    },
                    'subject_id[]': {
                        required: "Subject Required",
                    },
                    'full_mark[]': {
                        required: "Full Mark Required",
                    },
                    'pass_mark[]': {
                        required: "Pass Mark Required",
                    },
                    'get_mark[]': {
                        required: "Get Mark Required",
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
