@extends('backend.layouts.master')


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Students Fee</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Grade Point</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Students Fee Lists</h1>
                    <a href="{{ route('accStudentFeeAdd') }}" class="float-right btn btn-success"> <i
                            class="fa fa-plus-circle"></i>Add Student Fee</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>ID No</th>
                                <th>Name</th>
                                <th>Year</th>
                                <th>Class</th>
                                <th>Fee Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $data)
                                <tr class="{{ $data->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data['student']['id_no'] }}</td>
                                    <td>{{ $data['student']['name'] }}</td>
                                    <td>{{ $data['year']['name'] }}</td>
                                    <td>{{ $data['student_class']['name'] }}</td>
                                    <td>{{ $data['fee_category']['name'] }}</td>
                                    <td>{{ $data->amount }} TK</td>
                                    <td>{{ date('M Y', strtotime($data->date)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
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
