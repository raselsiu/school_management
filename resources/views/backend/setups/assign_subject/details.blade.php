@extends('backend.layouts.master')


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Details Assign Subject</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Details Fee Amount</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Class Level: <strong>{{ $editData['0']['studentClass']['name'] }}</strong></h1>
                    <a href="{{ route('assignSubjectView') }}" class="float-right btn btn-success"> <i
                            class="fa fa-list"></i> &nbsp;Assign Subject Lists</a>
                </div>

                <div class="card-body">


                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Subject</th>
                                <th>Full Mark</th>
                                <th>Pass Mark</th>
                                <th>Subjective Mark</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($editData as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value['subject']['name'] }}</td>
                                    <td>{{ $value->full_mark }}</td>
                                    <td>{{ $value->pass_mark }}</td>
                                    <td>{{ $value->get_mark }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Subject</th>
                                <th>Full Mark</th>
                                <th>Pass Mark</th>
                                <th>Subjective Mark</th>
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
@endpush
