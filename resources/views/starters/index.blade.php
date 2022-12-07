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
                <h6 class="m-0 font-weight-bold text-primary">Admin
                    <a href="javascript:void(0)">
                        <button type="button" id="addNewStarter" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add Starter Pack</button>
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
                            <th>Device</th>
                            <th>Serial No.</th>
                            <th>Date of Issuance</th>
                            <th>User</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($starters)
                            @foreach($starters as $starter)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $starter->device }}</td>
                                    <td>{{ $starter->serial_no }}</td>
                                    <td>{{ $starter->date_of_issuance }}</td>
                                    <td>{{ $starter->users->name }}</td>

                                    <td>
                                        <button class="btn btn-success btn-sm" style="background-color: #1e744b;">
                                            <a style="color: white; text-decoration: none;" class="edit" href="javascript:void(0)"
                                               data-id="{{ $starter->id }}"><i class="fa fa-pencil"></i> Edit </a></button>
                                        <button class="btn btn-danger btn-sm">
                                            <a style="color: white; text-decoration: none;" class="delete" href="javascript:void(0)"
                                               data-id="{{ $starter->id }}"><i class="fa fa-pencil"></i> Delete </a></button>
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
        <!-- boostrap model for Category -->
        <div class="modal fade" id="ajax-starter-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #30ab60; color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxStarterModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditStarterForm" name="addEditStarterForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="device" name="device" placeholder="Enter Device" value="" required>
                                    <span class="text-danger" id="deviceError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="serial_no" name="serial_no" placeholder="Enter Device" value="" required>
                                    <span class="text-danger" id="serial_noError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="date_of_issuance" name="date_of_issuance" placeholder="Enter Date of issuance" value="" required>
                                    <span class="text-danger" id="date_of_issuanceError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select class="form-control" name="user_id" id="select2-dropdown" required>
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="user_idError"></span>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewStarter">Save changes
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
    $(document).ready(function($){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addNewStarter').click(function () {
            $('#addEditStarterForm').trigger("reset");
            $('#ajaxStarterModel').html("Add A Starter Pack");
            $('#ajax-starter-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('starters-edit') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    $('#ajaxStarterModel').html("Edit Starter Pack");
                    $('#ajax-starter-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#device').val(res.message.device);
                    $('#serial_no').val(res.message.serial_no);
                    $('#date_of_issuance').val(res.message.date_of_issuance);
                    $('#user_id').val(res.message.user_id);

                }
            });
        });
        $('body').on('click', '.delete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Starter Pack!",
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
                            url: "{{ url('starters-delete') }}",
                            data: {id: id},
                            dataType: 'json',
                            success: function (res) {
                                swal('Success', 'Starter pack Deleted Successfully', 'success');
                                window.location.reload();
                            }
                        });
                    } else {
                        swal("Your Subject is safe!");
                    }
                });
        });
        $('#addEditStarterForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('starters-store') }}",
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
                    $('#deviceError').text(res.responseJSON.errors.device);
                    $('#serial_noError').text(res.responseJSON.errors.serial_no);
                    $('#date_of_issuanceError').text(res.responseJSON.errors.date_of_issuance);                    $('#categoryError').text(res.responseJSON.errors.category);
                    $('#user_idError').text(res.responseJSON.errors.user_id);

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

{{--THE END- CREATING A NEW Category--}}


