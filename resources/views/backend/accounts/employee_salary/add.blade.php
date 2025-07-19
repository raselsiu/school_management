@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Employee Salary</h1>
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
            <h1 class="card-title">Employee Salary</h1>
            <a href="{{ route('accStudentFeeView') }}" class="float-right btn btn-sm btn-success"> <i
                    class="fa fa-list"></i>
                &nbsp;Employee Salary Lists</a>
        </div>

        <div style="padding: 15px">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="control-label">Date</label>
                        <input type="date" name="date" id="date"
                            class="form-control form-control-sm singledatepicker" autocomplete="off" placeholder="Date">
                    </div>
                    <div class="form-group col-md-2">
                        <a class="btn btn-sm btn-success" id="search" style="margin-top: 29px; color: white">Search</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div id="DocumentResults"></div>
            <script id="document-template" type="text/x-handlebars-template">
        <form action="{{route('accEmployeeSalaryStore')}}" method="post">
            @csrf
            <table class="table-sm table-bordered table-striped " style="width: 100%">
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
            <button type="submit" class="btn btn-primary btn-sm" style="margin-top:10px;">Submit</button>
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
            var date = $('#date').val();
            $('.notifyjs-corner').html('');

            if (date == '') {
                $.notify("Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            $.ajax({
                url: "{{ route('accGetEmployee') }}",
                type: "get",
                data: {
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
