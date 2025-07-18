@extends('backend.layouts.master')


@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Manage Marks</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Marks Entry</li>
            </ol>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Search Criteria
                    </h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('storeMarks') }}" id="userForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="year_id">Year<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="year_id" id="year_id">
                                    <option value="">Select Year</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}">{{ $year->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="class_id">Class<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="class_id" id="class_id">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="assign_subject_id">Subject<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="assign_subject_id"
                                    id="assign_subject_id">
                                    <option value="">Select Subject</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exam_type">Exam Type<font style="color: red">*</font></label>
                                <select class="form-control form-control-sm" name="exam_type_id" id="exam_type_id">
                                    <option value="">Select Class</option>
                                    @foreach ($exam_types as $types)
                                        <option value="{{ $types->id }}">{{ $types->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-md-3">
                                <a id="search" name="search" class="btn btn-sm btn-success" style="color:#fff">Search
                                </a>
                            </div>
                        </div>
                        <br>

                        <div class="row d-none" id="marks_entry">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped dt-responsive">
                                    <thead>
                                        <tr>
                                            <th>ID No.</th>
                                            <th>Student Name</th>
                                            <th>Fathers Name</th>
                                            <th>Gender</th>
                                            <th>Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody id="marks_entry-tr">

                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">Save</button>
                        </div>



                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="{{ asset('backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('backend/js/notify.min.js') }}"></script>



    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var exam_type_id = $('#exam_type_id').val();
            var assign_subject_id = $('#assign_subject_id').val();
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
            if (assign_subject_id == '') {
                $.notify("Subject required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (exam_type_id == '') {
                $.notify("Exam Type required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            $.ajax({
                url: "{{ route('getStudent') }}",
                type: "GET",
                data: {
                    'year_id': year_id,
                    'class_id': class_id
                },
                success: function(data) {
                    $('#marks_entry').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        html +=
                            '<tr>' +
                            '<td>' + v.student.id_no +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"><input type="hidden" name="id_no[]" value="' + v
                            .student.id_no + '"></td>' +
                            '<td>' + v.student.name + '</td>' +
                            '<td>' + v.student.fname + '</td>' +
                            '<td>' + v.student.gender + '</td>' +
                            '<td><input type="text" class="form-control form-control-sm" name="marks[]"></td>' +
                            '</tr>';
                    });
                    html = $('#marks_entry-tr').html(html);
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



    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#class_id', function() {
                var class_id = $('#class_id').val();
                $.ajax({
                    url: "{{ route('getSubject') }}",
                    type: "GET",
                    data: {
                        class_id: class_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select Subject</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.id + '">' + v.subject.name +
                                '</option>';
                        });
                        $('#assign_subject_id').html(html);
                    }
                });
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
                    "marks[]": {
                        required: true,
                    },
                    "assign_subject_id": {
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
