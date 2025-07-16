@extends('backend.layouts.master')


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Employee Monthly Salary</h1>
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
                    <h3 class="card-title">Select Date</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="control-label">Date</label>
                            <input type="date" name="date" id="date"
                                class="form-control form-control-sm singledatepicker" autocomplete="off" placeholder="Date">
                        </div>
                        <div class="form-group col-md-2">
                            <a class="btn btn-sm btn-success" id="search"
                                style="margin-top: 29px; color: white">Search</a>
                        </div>
                    </div>
                </div>
                <div id="DocumentResults"></div>
                <script id="document-template" type="text/x-handlebars-template">
                <table class="table-sm table-bordered table-striped " style="width: 100%" >
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
            </script>
            </div>
        </div>
    </div>
    </div>
@endsection


@push('js')
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
                url: "{{ route('employeeMonthlySalaryGetSalary') }}",
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


    <script>
        $(function() {
            $(document).on('click', '#deleteEvent', function(e) {
                e.preventDefault();
                var link = $(this).attr('href');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            })
        })
    </script>
@endpush
