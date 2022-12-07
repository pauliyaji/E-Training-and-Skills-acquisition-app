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
                <h6 class="m-0 font-weight-bold text-primary">All Feedback
                    <a href="javascript:void(0)">
                        <a href="{{ route('feedbacks.myfeedback') }}"><button type="button"class="btn btn-success btn-flat add_new_feedbacks m-1 float-right" data-name="">
                                View My Feedback</button></a>
                        <button type="button" id="addNewFeedback" class="btn btn-success btn-flat add_new_feedbacks m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add Feedback</button>
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
                            <th>User</th>
                            <th>Type</th>
                            <th>Feedback</th>
                            <th>Date of Entry</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($feedbacks)
                            @foreach($feedbacks as $feedback)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $feedback->users->name }}</td>
                                    <td>{{ $feedback->usertypes->type }}</td>
                                    <td>{{ $feedback->feedback }} </td>
                                    <td>{{date('d-m-Y', strtotime($feedback->created_at))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical dropdown-toggle" data-bs-toggle="dropdown" viewBox="0 0 16 16">
                                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>

                                            <ul class="dropdown-menu pl-3 ">

                                                <li style="padding-bottom: 3px"><a href="javascript:void(0)" class="edit" data-id="{{ $feedback->id }}"
                                                                                   style="text-decoration: none; color:#4e4c4c"><i class="fa fa-edit"></i> Edit</a></li>
                                                <li style="padding-bottom: 3px"><a href="javascript:void(0)" class="delete" data-id="{{ $feedback->id }}" style="text-decoration: none; color:#4e4c4c">
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
        <!-- boostrap model for Feedback -->
        <div class="modal fade" id="ajax-Feedback-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #30ab60; color: white;">
                        <h4 class="modal-title" id="ajaxFeedbackModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditFeedbackForm" name="addEditFeedbackForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">

                            <div class="form-group">

                                <div class="col-sm-12">
                                    <label>Feedback</label>
                                    <textarea class="form-control" id="feedback"
                                       name="feedback" value="" maxlength="400" required ></textarea>
                                    <span class="text-danger" id="feedbackError"></span>
                                </div>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewFeedback">Save changes
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

        $('#addNewFeedback').click(function () {
            $('#addEditFeedbackForm').trigger("reset");
            $('#ajaxFeedbackModel').html("Add New Feedback");
            $('#ajax-Feedback-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('feedbacks-edit') }}",
                data: {id: id},
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    $('#ajaxFeedbackModel').html("Edit Feedback");
                    $('#ajax-Feedback-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#feedback').val(res.message.feedback);

                }
            });
        });
        $('body').on('click', '.delete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Feedback!",
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
                            url: "{{ url('feedbacks-delete') }}",
                            data: {id: id},
                            dataType: 'json',
                            success: function (res) {
                                swal('Warning', res.message, 'warning');

                                window.location.reload();
                            },
                            error: function (error) {
                                swal('Warning', 'You are not allowed to delete a feedback you did not post', 'warning');
                            }
                        });
                    } else {
                        swal("Your Feedback is safe!");
                    }
                });
        });

        $('#addEditFeedbackForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('feedbacks-store') }}",
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
                    $('#feedbackError').text(res.responseJSON.errors.feedback);
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

{{--THE END- CREATING A NEW Feedback--}}


