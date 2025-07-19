@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Others Cost</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Employee Attendance</li>
            </ol>
        </div>
    </div>
    <br>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                @if (isset($editData))
                    Edit Cost
                @else
                    Add Cost
                @endif
            </h3>
            <a href="{{ route('OthersCostview') }}" class="btn btn-success float-right btn-sm"><i class="fa fa-list">
                    Others Cost List</i></a>
        </div>

        <div class="card-body">
            <form method="post"
                action="{{ @$editData ? route('OthersCostupdate', $editData->id) : route('OthersCoststore') }}"
                id="myForm" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Date</label>
                        <input type="date" name="date" value="{{ @$editData->date }}"
                            class="form-control singledatepicker" placeholder="Date">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Amount</label>
                        <input type="text" name="amount" value="{{ @$editData->amount }}" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                    <div class="form-group col-md-4">
                        <img id="showImg"
                            src="{{ !empty(@$editData->image) ? asset('/upload/cost_images/' . @$editData->image) : asset('uploads/no_img.png') }}"
                            style="width: 300px;height: 100px;border:1px solid #000;">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ @$editData->description }}</textarea>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary">{{ @$editData ? 'Update' : 'Submit' }}</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection


@push('js')
    <script src="{{ asset('backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>




    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    date: {
                        required: true,
                    },
                    amount: {
                        required: true,
                    },
                    description: {
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
@endpush
