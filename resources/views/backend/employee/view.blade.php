@extends('backend.layouts.master')


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Employee Registration</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Employee</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Employee Lists</h1>
                    <a href="{{ route('employeeRegiAdd') }}" class="float-right btn btn-success"> <i
                            class="fa fa-plus-circle"></i> Add Employee</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>ID No.</th>
                                <th>Mobile No.</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Join Date</th>
                                <th>Salary</th>
                                @if (Auth::user()->role == 'Admin')
                                    <th>Code</th>
                                @endif
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($allData as $key => $employee)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->id_no }}</td>
                                    <td>{{ $employee->mobile }}</td>
                                    <td>{{ $employee->address }}</td>
                                    <td>{{ $employee->gender }}</td>
                                    <td>{{ date('d-m-Y', strtotime($employee->join_date)) }}</td>
                                    <td>{{ $employee->salary }}</td>
                                    @if (Auth::user()->usertype == 'Admin')
                                        <td>{{ $employee->code }}</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('employeeRegiEdit', $employee->id) }}" title="Edit"
                                            class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                                        <a target="_blank" href="{{ route('employeeRegiDetails', $employee->id) }}"
                                            title="Edit" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>ID No.</th>
                                <th>Mobile No.</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Join Date</th>
                                <th>Salary</th>
                                @if (Auth::user()->role == 'Admin')
                                    <th>Code</th>
                                @endif
                                <th>Actions</th>
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
