@extends('backend.layouts.master')


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3>Manage Monthly/Yearly Profit</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Monthly/Yearly Profit</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Select Criteria</h5>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="control-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date"
                                class="singledatepicker form-control form-control-sm" autocomplete="off"
                                placeholder="Start Date">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">End Date</label>
                            <input type="date" name="end_date" id="end_date"
                                class="singledatepicker form-control form-control-sm" autocomplete="off"
                                placeholder="End Date">
                        </div>
                        <div class="form-group col-md-2">
                            <a class="btn btn-sm btn-block btn-success" id="search"
                                style="margin-top: 29px; color: white">Search</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div id="DocumentResults"></div>
                    <script id="document-template" type="text/x-handlebars-template">
                    <table class="table-sm table-bordered table-striped" style="width: 100%">
                        <thead>
                            <tr>
                            @{{{thsource}}}
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            @{{{tdsource}}}
                            </tr>
                        </tbody>
                    </table>
                </script>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('js')
    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            $('.notifyjs-corner').html('');

            if (start_date == '') {
                $.notify("Start Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (end_date == '') {
                $.notify("End Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }

            $.ajax({
                url: "{{ route('getReportProfitDateWise') }}",
                type: "GET",
                data: {
                    start_date: start_date,
                    end_date: end_date
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








    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
