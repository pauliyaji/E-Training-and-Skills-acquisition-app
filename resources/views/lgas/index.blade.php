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
                <h6 class="m-0 font-weight-bold text-primary">All LGA/Departments
                    <a href="javascript:void(0)">
                        <button type="button" id="addNewLga" class="btn btn-success btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> Add LGA/Department</button>
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
                            <th>LGA/Department</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($lgas)
                            @foreach($lgas as $lga)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lga->title }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" style="background-color: #1e744b;">
                                            <a style="color: white; text-decoration: none;" class="edit" href="javascript:void(0)"
                                               data-id="{{ $lga->id }}"><i class="fa fa-pencil"></i> Edit </a></button>
                                        <button class="btn btn-danger btn-sm">
                                            <a style="color: white; text-decoration: none;" class="delete" href="javascript:void(0)"
                                               data-id="{{ $lga->id }}"><i class="fa fa-pencil"></i> Delete </a></button>
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
        <div class="modal fade" id="ajax-lga-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #30ab60; color: white; align-items: center;">
                        <h4 class="modal-title" id="ajaxLgaModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditLgaForm" name="addEditLgaForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label"></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Category" value="" maxlength="50" required>
                                    <span class="text-danger" id="titleError"></span>
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewLga">Save changes
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

        $('#addNewLga').click(function () {
            $('#addEditLgaForm').trigger("reset");
            $('#ajaxLgaModel').html("Add A Record");
            $('#ajax-lga-model').modal('show');
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('lgas-edit') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    $('#ajaxLgaModel').html("Edit Record");
                    $('#ajax-lga-model').modal('show');
                    $('#id').val(res.message.id);
                    $('#title').val(res.message.title);

                }
            });
        });
        $('body').on('click', '.delete', function () {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Record!",
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
                            url: "{{ url('lgas-delete') }}",
                            data: {id: id},
                            dataType: 'json',
                            success: function (res) {
                                swal('Success', 'Record Deleted Successfully', 'success');
                                window.location.reload();
                            }
                        });
                    } else {
                        swal("Your Record is safe!");
                    }
                });
        });
        $('#addEditLgaForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('lgas-store') }}",
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


