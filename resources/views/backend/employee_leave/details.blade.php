@extends('backend.layouts.master')


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Employee Salary</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Employee Salary</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Employee Lists</h1>
                </div>
                <div class="card-body">
                    <strong>Employee Name: </strong>{{ $details->name }} &nbsp;&nbsp; <strong>Employee ID No: </strong>
                    {{ $details->id_no }}
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Previous Salary</th>
                                <th>Increment Salary</th>
                                <th>Present Salary</th>
                                <th>Effected Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($salary_log as $key => $value)
                                <tr>
                                    @if ($key == '0')
                                        <td colspan="5" style="text-align: center"><strong>Joining Salary:
                                                {{ $value->previous_salary }}</strong>
                                        </td>
                                    @else
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->previous_salary }}</td>
                                        <td>{{ $value->increment_salary }}</td>
                                        <td>{{ $value->present_salary }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->effected_date)) }}</td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SL No.</th>
                                <th>Previous Salary</th>
                                <th>Increment Salary</th>
                                <th>Present Salary</th>
                                <th>Effected Date</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
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
