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
                <h6 class="m-0 font-weight-bold text-primary">All Batches
                    <a href="javascript:void(0)">
                        <button type="button" id="addNewBatch" class="btn btn-success btn-flat add_new_batches m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add New Batch</button>
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
                            <th>description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($batches)
                            @foreach($batches as $batch)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $batch->title }}</td>
                                    <td>{{ $batch->description }}</td>
                                    <td>{{ $batch->start_date }}</td>
                                    <td>{{ $batch->end_date }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-warning btn-sm edit" data-id="{{ $batch->id }}"
                                           style="text-decoration: none; color:#4e4c4c"><i class="fa fa-edit"></i> Edit</a>
                                      {{-- <a href="{{ route('classes.list', $batch->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View Classes</a>--}}
                                       <a href="{{ route('classes.add-class', $batch->id) }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add Student to Class</a>

                                    </td>
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
        <div class="modal fade" id="ajax-Batch-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #30ab60; color: white;">
                        <h4 class="modal-title" id="ajaxBatchModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditBatchForm" name="addEditBatchForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Batch Title" value="" maxlength="50" required>
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
                                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" value="" maxlength="50">
                                    <span class="text-danger" id="start_dateError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="End Date" value="" maxlength="50">
                                    <span class="text-danger" id="end_dateError"></span>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewBatch">Save changes
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

        $('#addNewBatch').click(function () {
            $('#addEditBatchForm').trigger("reset");
            $('#ajaxBatchModel').html("Add New Batch");
            $('#ajax-Batch-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('batches-edit') }}",
                data: {id: id},
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    $('#ajaxBatchModel').html("Edit Batch");
                    $('#ajax-Batch-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#title').val(res.message.title);
                    $('#description').val(res.message.description);
                    $('#start_date').val(res.message.start_date);
                    $('#end_date').val(res.message.end_date);
                }
            });
        });
        $('body').on('click', '.delete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Batch!",
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
                            url: "{{ url('batches-delete') }}",
                            data: {id: id},
                            dataType: 'json',
                            success: function (res) {
                                swal('Success', 'Batch Deleted Successfully', 'success');
                                window.location.reload();
                            }
                        });
                    } else {
                        swal("Your Batch is safe!");
                    }
                });
        });

        $('#addEditBatchForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('batches-store') }}",
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
                    $('#start_dateError').text(res.responseJSON.errors.start_date);
                    $('#end_dateError').text(res.responseJSON.errors.end_date);

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


