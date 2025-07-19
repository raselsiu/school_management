@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Student Fee</h1>
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
            <h1 class="card-title">Student Fee</h1>
            <a href="{{ route('accStudentFeeView') }}" class="float-right btn btn-sm btn-success"> <i
                    class="fa fa-list"></i>
                &nbsp;Student Fee Lists</a>
        </div>

        <div style="padding: 15px">
            <div class="form-row">

                <div class="form-group col-md-3">
                    <label for="year_id">Select Year</label>
                    <select name="year_id" id="year_id" class="form-control select2bs4">
                        <option value="">Select Year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="class_id">Class</label>
                    <select name="class_id" id="class_id" class="form-control select2bs4">
                        <option selected value="">Select Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Fee Category</label>
                    <select name="fee_category_id" id="fee_category_id" class="form-control select2bs4">
                        <option value="">Select Fee Category</option>
                        @foreach ($fee_categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" name="date" id="date" class="form-control singledatepicker"
                        placeholder="DD-MM-YYYY">
                </div>

                <div class="form-group col-md-3">
                    <a id="search" class="btn btn-primary" name="search">Search</a>
                </div>

            </div>
        </div>

        <div class="card-body">
            <div id="DocumentResults"></div>
            <script id="document-template" type="text/x-handlebars-template">
            <form action="{{route('accStudentFeeStore')}}" method="post">
                @csrf
                <table class="table-sm table-bordered table-striped" style="width: 100%">
                    <thead>
                        <tr>
                            @{{{thsource}}}
                        </tr>
                    </thead>
                    <tbody>
                        @{{#each this}}
                        <tr>
                            @{{{tdsource}}}
                        </tr>
                        @{{/each}}
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 10px;">Submit</button>
            </form>
        </script>
        </div>
    </div>
@endsection


@push('js')
    <script src="{{ asset('backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>





    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var fee_category_id = $('#fee_category_id').val();
            var date = $('#date').val();
            $('.notifyjs-corner').html('');

            if (year_id == '') {
                $.notify("Year required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (class_id == '') {
                $.notify("Class required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (fee_category_id == '') {
                $.notify("Fee Category required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (date == '') {
                $.notify("Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            $.ajax({
                url: "{{ route('accGetStudent') }}",
                type: "get",
                data: {
                    'year_id': year_id,
                    'class_id': class_id,
                    'fee_category_id': fee_category_id,
                    'date': date
                },
                beforeSend: function() {},
                success: function(data) {
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $('#DocumentResults').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script>
@endpush
