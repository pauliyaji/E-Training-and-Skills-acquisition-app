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
                <h6 class="m-0 font-weight-bold text-primary">All Subjects
                    <a href="javascript:void(0)">
                        <button type="button" id="addNewSubject" class="btn btn-success btn-flat add_new_courses m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add Subject</button>
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
                            <th>Duration</th>
                            <th>Course</th>
                            <th>File</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($subjects)
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subject->title }}</td>
                                    <td>{{ $subject->duration }} days</td>
                                    <td>{{ $subject->courses->title }}</td>
                                    @if(is_null($subject->file))
                                    <td>
                                        No file uploaded
                                    </td>
                                        @else
                                        <td><a href="{{ route('subjects.download', $subject->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                        </td>
                                        @endif
                                    <td>
                                        <div class="btn-group">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical dropdown-toggle" data-bs-toggle="dropdown" viewBox="0 0 16 16">
                                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>

                                            <ul class="dropdown-menu pl-3 ">

                                                <li style="padding-bottom: 3px"><a href="javascript:void(0)" class="edit" data-id="{{ $subject->id }}" style="text-decoration: none; color:#4e4c4c"><i class="fa fa-edit"></i> Edit</a></li>
                                                <li style="padding-bottom: 3px"><a href="javascript:void(0)" class="delete" data-id="{{ $subject->id }}" style="text-decoration: none; color:#4e4c4c">
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
        <div class="modal fade" id="ajax-Subject-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #30ab60; color: white;">
                        <h4 class="modal-title" id="ajaxSubjectModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditSubjectForm" name="addEditSubjectForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3">Enter Subject Title</span>
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
                                        <span class="input-group-text" id="basic-addon3">Duration (number of days)</span>
                                        <input type="number" class="form-control" id="duration" name="duration" value="" maxlength="50" required>
                                    </div>
                                    <span class="text-danger" id="durationError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select class="form-control" name="course_id" id="select2-dropdown" required>
                                        <option value="">Select Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{$course->id}}>{{ $course->title }}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger" id="course_idError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-6 control-label">Upload your file</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" id="file" name="file" value="">
                                    <span class="text-danger" id="fileError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <img id="preview-file-before-upload" src="#"
                                         alt="preview file" style="max-height: 250px;">
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewSubject">Save changes
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

@include('layouts/footer')


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

        $('#addNewSubject').click(function () {
            $('#addEditSubjectForm').trigger("reset");
            $('#ajaxSubjectModel').html("Add New Subject");
            $('#ajax-Subject-model').modal('show');
        });

        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-file-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('subjects-edit') }}",
                data: {id: id},
                dataType: 'json',
                success: function (res) {

                    $('#ajaxSubjectModel').html("Edit Course");
                    $('#ajax-Subject-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#title').val(res.message.title);
                    $('#duration').val(res.message.duration);
                    $('#description').val(res.message.description);
                    $('#course_id').val(res.message.courses.title);
                    $('#file').val(res.message.file);

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
                            url: "{{ url('subjects-delete') }}",
                            data: {id: id},
                            dataType: 'json',
                            success: function (res) {
                                swal('Success', 'Subject Deleted Successfully', 'success');
                                window.location.reload();
                            }
                        });
                    } else {
                        swal("Your Subject is safe!");
                    }
                });
        });

        $('#addEditSubjectForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('subjects-store') }}",
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
                    $('#durationError').text(res.responseJSON.errors.duration);
                    $('#course_idError').text(res.responseJSON.errors.course_id);
                    $('#fileError').text(res.responseJSON.errors.file);
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


