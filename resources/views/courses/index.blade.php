@extends('layouts/layout')

@section('content')
    <style>
        .toggle-off.btn {
            padding-left: 15px;
        }
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Courses
                    <a href="javascript:void(0)">
                        <button type="button" id="addNewCourse" class="btn btn-success btn-flat add_new_courses m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add Course</button>
                    </a>
                </h6>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <p class="text-success">{{ Session('success') }}</p>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Duration</th>
                            <th>Created By</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($courses)
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->categories->category }}</td>
                                    <td>{{ $course->duration }} days</td>
                                    <td>{{ $course->users->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical dropdown-toggle" data-bs-toggle="dropdown" viewBox="0 0 16 16">
                                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>

                                            <ul class="dropdown-menu pl-3 ">

                                                <li style="padding-bottom: 3px"><a href="javascript:void(0)" class="edit" data-id="{{ $course->id }}" style="text-decoration: none; color:#4e4c4c"><i class="fa fa-edit"></i> Edit</a></li>
                                                <li style="padding-bottom: 3px"><a href="javascript:void(0)" class="delete" data-id="{{ $course->id }}" style="text-decoration: none; color:#4e4c4c">
                                                        <i class="fa fa-trash"></i> Delete</a></li>

                                            </ul>
                                        </div>    </td>
                                </tr>
                            @endforeach

                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- boostrap model for Course -->
        <div class="modal fade" id="ajax-Course-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #30ab60; color: white;">
                        <h4 class="modal-title" id="ajaxCourseModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditCourseForm" name="addEditCourseForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3">Enter Course Title</span>
                                        <input type="text" class="form-control" id="title" name="title" value="" maxlength="50" required>
                                    </div>
                                    <span class="text-danger" id="titleError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="description" name="description" placeholder="Description" value="" maxlength="400" required ></textarea>
                                    <span class="text-danger" id="descriptionError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3">No. of Subjects</span>
                                        <input type="number" class="form-control" id="no_of_subjects" name="no_of_subjects" value="" maxlength="50" required>
                                    </div>
                                    <span class="text-danger" id="no_of_subjectError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3">Duration (number of days)</span>
                                        <input type="number" class="form-control" id="duration" name="duration" value="" maxlength="50" required>
                                    </div>
                                    <span class="text-danger" id="durationError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3">Minimum Attendance (number of days)</span>
                                        <input type="number" class="form-control" id="minimum_attendance" name="minimum_attendance" value="" maxlength="50" required>
                                    </div>
                                    <span class="text-danger" id="minimum_attendanceError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select class="form-control" name="category_id" id="select2-dropdown" required>
                                        <option value="">Select Course Type</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if($category->category_id==$category->id) selected @endif
                                                {{$category->id}}>{{ $category->category }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="category_idError"></span>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewCourse">Save changes
                                </button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });
</script>


<script type="text/javascript">
    $(document).ready(function($) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addNewCourse').click(function () {
            $('#addEditCourseForm').trigger("reset");
            $('#ajaxCourseModel').html("Add New Course");
            $('#ajax-Course-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('courses-edit') }}",
                data: {id: id},
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    $('#ajaxCourseModel').html("Edit Course");
                    $('#ajax-Course-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#title').val(res.message.title);
                    $('#duration').val(res.message.duration);
                    $('#description').val(res.message.description);
                    $('#no_of_subjects').val(res.message.no_of_subjects);
                    $('#minimum_attendance').val(res.message.minimum_attendance);
                    $('#category_id').val(res.message.categories.category);

                }
            });
        });
        $('body').on('click', '.delete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Course!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var id = $(this).data('id');

                        // ajax
                        $.ajax({
                            type: "POST",
                            url: "{{ url('courses-delete') }}",
                            data: {id: id},
                            dataType: 'json',
                            success: function (res) {
                                swal('Success', 'Course Deleted Successfully', 'success');

                                window.location.reload();
                            }
                        });
                    } else {
                        swal("Your Course is safe!");
                    }
        });
        });

        $('#addEditCourseForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('courses-store') }}",
                data: formData,
                contentType: false,
                processData: false,

                dataType: 'json',
                success: function(res){
                    console.log(res);
                    window.location.reload();
                    $("#btn-save").html('Submit');
                    $("#btn-save"). attr("disabled", false);
                },
                error: function(res){
                    $('#titleError').text(res.responseJSON.errors.title);
                    $('#descriptionError').text(res.responseJSON.errors.description);
                    $('#no_of_subjectsError').text(res.responseJSON.errors.no_of_subjects);
                    $('#durationError').text(res.responseJSON.errors.duration);
                    $('#minimum_attendanceError').text(res.responseJSON.errors.minimum_attendance);
                    $('#category_idError').text(res.responseJSON.errors.category_id);




                }
            });
        });

    });
</script>
<script>
    $(document).ready(function () {
        $('#select2-dropdown').select2();
        $('#select2-dropdown').on('change', function (e) {
            var data = $('#select2-dropdown').select2("val");
            $("#select2-dropdown").val(data);
        });
    });
</script>

{{--THE END- CREATING A NEW Course--}}


