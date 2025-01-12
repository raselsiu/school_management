@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Fee Category Amount</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Fee Amount</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Edit Fee Category Amount</h1>
                    <a href="{{ route('studentFeeCategoryAmountView') }}" class="float-right btn btn-sm btn-success"> <i
                            class="fa fa-list"></i>
                        &nbsp;View All Fee Category Amount</a>
                </div>
                <form method="POST" action="{{ route('studentFeeCategoryAmountUpdate', $editData[0]->fee_category_id) }}"
                    id="userForm">
                    @csrf
                    <div class="card-body">



                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Fee Category</label>
                                <select class="custom-select" name="fee_category_id" id="fee_category_id">
                                    <option value="">Select Fee Category</option>
                                    @foreach ($fee_category as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $editData[0]->fee_category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('feee_category_id'))
                                    <span style="color: red">Select Category</span>
                                @endif
                            </div>
                        </div>


                        @foreach ($editData as $edit)
                            <div id="fieldsContainer">
                                <div class="fieldRow">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Class</label>
                                            <select class="custom-select" name="class_id[]" id="class_id" required>
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ $edit->class_id == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('class_id'))
                                                <span style="color: red">Select Class</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="name">Amount</label>
                                            <input type="number" class="form-control" name="amount[]"
                                                value="{{ $edit->amount }}" id="amount" placeholder="Enter Class Name"
                                                required>
                                            @if ($errors->has('amount'))
                                                <span style="color: red">{{ $errors->first('amount') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button type="button" class="addFieldBtn btn btn-success">+</button>
                                            <button type="button" class="removeFieldBtn btn btn-danger"
                                                style="">-</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                        <button type="submit" class="btn btn-primary">Save</button>
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
                 <div class="fieldRow">
                                <div class="row">
       <div class="form-group col-md-4">
                                        <label>Class</label>
                                        <select class="custom-select" name="class_id[]" id="class_id"  required>
                                            <option value="">Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('class_id'))
                                            <span style="color: red">Select Class</span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="name">Amount</label>
                                        <input type="number" class="form-control" name="amount[]" id="amount"
                                            placeholder="Enter Class Name"  required>
                                        @if ($errors->has('amount'))
                                            <span style="color: red">{{ $errors->first('amount') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="button" class="addFieldBtn btn btn-success">+</button>
                                        <button type="button" class="removeFieldBtn btn btn-danger">-</button>
                                    </div>
                                </div>
                            </div>
        `;
                $('#fieldsContainer').append(newRow);

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
                    "fee_category_id": {
                        required: true,
                    },

                    "class_id[]": {
                        required: true,
                    },

                    "amount[]": {
                        required: true,
                    },
                },
                messages: {},
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




    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>
@endpush
