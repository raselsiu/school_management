@extends('backend.layouts.master')


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Student Registration</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Student Lists</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Student Lists</h1>
                    <a href="{{ route('studentRegiAdd') }}" class="float-right btn btn-success"> <i
                            class="fa fa-plus-circle"></i> Add Student</a>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('searchYearClass') }}" id="userForm">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="year_id">Year<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="year_id" id="year_id">
                                    <option value="">Select Year</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}" {{ @$year_id == $year->id ? 'selected' : '' }}>
                                            {{ $year->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="class_id">Class<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="class_id" id="class_id">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ @$class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4" style="padding-top: 32px">
                                <button type="submit" name="search" class="btn btn-sm btn-success">Search Student</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @if (!@$search)
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>ID No.</th>
                                    <th>Roll</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    @if (Auth::user()->role == 'Admin')
                                        <th>Code</th>
                                    @endif
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($allData as $key => $student)
                                    <tr>
                                        <td width='5%'>{{ $key + 1 }}</td>
                                        <td>{{ $student['student']['name'] }}</td>
                                        <td>{{ $student['student']['id_no'] }}</td>
                                        <td>{{ $student->roll }}</td>
                                        <td>{{ $student['year']['name'] }}</td>
                                        <td>{{ $student['studentClass']['name'] }}</td>
                                        @if (Auth::user()->usertype == 'Admin')
                                            <td>{{ $student['student']['code'] }}</td>
                                        @endif
                                        <td>
                                            <img src="{{ !empty($student['student']['image']) ? url('/upload/student_image/' . $student['student']['image']) : asset('uploads/no_img.png') }}"
                                                alt="Preview Image" height="40px" width="40px"
                                                style="border: 1px solid #cac2c2; border-radius: 5px;display: table;margin:0 auto;">
                                        </td>
                                        <td width='15%'>
                                            <a href="{{ route('studentRegiEdit', $student->student_id) }}" title="Edit"
                                                class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>
                                            </a>

                                            <a href="{{ route('promotion', $student->student_id) }}" title="Promotion"
                                                class="btn btn-sm btn-success"><i class="fa fa-check"></i>
                                            </a>


                                            <a target="_blank" href="{{ route('studentDetails', $student->student_id) }}"
                                                title="Details" class="btn btn-sm btn-info"><i class="fa fa-eye"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>ID No.</th>
                                    <th>Roll</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    @if (Auth::user()->role == 'Admin')
                                        <th>Code</th>
                                    @endif
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>ID No.</th>
                                    <th>Roll</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    @if (Auth::user()->usertype == 'Admin')
                                        <th>Code</th>
                                    @endif

                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($allData as $key => $student)
                                    <tr>
                                        <td width='5%'>{{ $key + 1 }}</td>
                                        <td>{{ $student['student']['name'] }}</td>
                                        <td>{{ $student['student']['id_no'] }}</td>
                                        <td>{{ $student->roll }}</td>
                                        <td>{{ $student['year']['name'] }}</td>
                                        <td>{{ $student['studentClass']['name'] }}</td>
                                        @if (Auth::user()->usertype == 'Admin')
                                            <td>{{ $student['student']['code'] }}</td>
                                        @endif
                                        <td>
                                            <img src="{{ !empty($student['student']['image']) ? url('/upload/student_image/' . $student['student']['image']) : asset('uploads/no_img.png') }}"
                                                alt="Preview Image" height="40px" width="40px"
                                                style="border: 1px solid #cac2c2; border-radius: 5px;display: table;margin:0 auto;">
                                        </td>
                                        <td width='15%'>
                                            <a href="{{ route('studentRegiEdit', $student->student_id) }}" title="Edit"
                                                class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>
                                            </a>

                                            <a href="{{ route('promotion', $student->student_id) }}" title="Promotion"
                                                class="btn btn-sm btn-success"><i class="fa fa-check"></i>
                                            </a>

                                            <a target="_blank" href="{{ route('studentDetails', $student->student_id) }}"
                                                title="Details" class="btn btn-sm btn-info"><i class="fa fa-eye"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>ID No.</th>
                                    <th>Roll</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    @if (Auth::user()->usertype == 'Admin')
                                        <th>Code</th>
                                    @endif
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="{{ asset('backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,

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

    <script>
        $(function() {
            $('#userForm').validate({
                rules: {
                    year_id: {
                        required: true,
                    },
                    class_id: {
                        required: true,
                    }
                },
                messages: {
                    year_id: {
                        required: "Year is Required",
                    },
                    class_id: {
                        required: "Class is Required",
                    }
                },
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
