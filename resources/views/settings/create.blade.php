@extends('layouts/layout')

@section('content')
    <style>
        .form-control::-webkit-input-placeholder {
            color: #757373;
            font-family: Courier;
        }
    </style>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Settings

                        <a href="javascript:void(0)">
                            <button type="button" id="addNewOrg" class="btn btn-success btn-flat m-1 add_new_settings float-right" data-name="">
                                <i class="fa fa-plus-circle text-white fa-lg"></i> Organisation</button>
                        </a>
                    <a href="javascript:void(0)">
                        <button type="button" id="addNewBook" class="btn btn-info btn-flat add_new_settings m-1 float-right" data-name="">
                            <i class="fa fa-plus-circle text-white fa-lg"></i> State</button>
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
                            <th>Institution</th>
                            <th>Center/Location</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($settings as $setting)
                            <tr>
                                <td>{{ $setting->id  }}</td>
                                <td>{{ $setting->institution }}</td>
                                <td>{{ $setting->center  }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                style="background-color: #0606a4;">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fa fa-eye"></i> View</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0)" data-id="{{ $setting->id }}"><i class="fa fa-list"></i> Receipt</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0)" data-id="{{ $setting->id }}"><i class="fa fa-trash"></i> Delete</a></li>
                                        </ul>
                                    </div>   </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal Institutions-->
        <!-- boostrap model for State -->
        <div class="modal fade" id="ajax-book-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #30ab60; color: white;">
                        <h4 class="modal-title" id="ajaxBookModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                           @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select class="form-control" name="institution" id="select2-dropdown" required>
                                    <option value="">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->state }}"
                                                {{$state->id}}>{{ $state->state }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="institutionError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label"></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="lga_depts" name="lga_depts" placeholder="Enter LGA" value="" maxlength="255" required>
                                    <span class="text-danger" id="lga_deptsError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="center" name="center" placeholder="Enter Center/Location" value="" required>
                                    <span class="text-danger" id="centerError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter official email" value="" required>
                                    <span class="text-danger" id="emailError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="" required>
                                    <span class="text-danger" id="phoneError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-6 control-label">Upload your logo</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" id="image" name="image" value="">
                                    <span class="text-danger" id="imageError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                         alt="preview image" style="max-height: 250px;">
                                </div>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewBook">Save changes
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <!-- end bootstrap model for Organisations -->
        <div class="modal fade" id="ajax-org-model" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #30ab60; color: white;">
                        <h4 class="modal-title" id="ajaxOrgModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditOrgForm" name="addEditOrgForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="institution" name="institution" placeholder="Enter Name of Organization" value="" maxlength="255" required>
                                    <span class="text-danger" id="institutionError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label"></label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="lga_depts" name="lga_depts" placeholder="Enter Department" value="" maxlength="255" required>
                                    <span class="text-danger" id="lga_deptsError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="center" name="center" placeholder="Enter Center/Location" value="" required>
                                    <span class="text-danger" id="centerError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter official email" value="" required>
                                    <span class="text-danger" id="emailError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="" required>
                                    <span class="text-danger" id="phoneError"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-6 control-label">Upload your logo</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" id="image" name="image" value="">
                                    <span class="text-danger" id="imageError"></span>
                                </div>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewBook">Save changes
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

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

{{--CREATING A NEW SETTING--}}

<script type="text/javascript">
    $(document).ready(function($){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addNewBook').click(function () {
            $('#addEditBookForm').trigger("reset");
            $('#ajaxBookModel').html("Add Your Settings");
            $('#ajax-book-model').modal('show');
        });
        $('#addNewOrg').click(function () {
            $('#addEditOrgForm').trigger("reset");
            $('#ajaxOrgModel').html("Add Your Settings");
            $('#ajax-org-model').modal('show');
        });

        $('#image').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('body').on('click', '.edit', function () {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type:"POST",
                url: "{{ url('edit-settings') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    $('#ajaxBookModel').html("Edit Settings");
                    $('#ajax-book-model').modal('show');
                    $('#id').val(res.id);
                    $('#institution').val(res.institution);
                    $('#lga_depts').val(res.lga_depts);
                    $('#center').val(res.center);
                    $('#email').val(res.email);
                    $('#phone').val(res.phone);
                    $('#address').val(res.address);
                    $('#description').val(res.description);
                    $('#image').val(res.image);

                }
            });
        });
        $('body').on('click', '.delete', function () {
            if (confirm("Delete Record?") == true) {
                var id = $(this).data('id');

                // ajax
                $.ajax({
                    type:"POST",
                    url: "{{ url('settings.delete') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                        window.location.reload();
                    }
                });
            }
        });
        $('#addEditBookForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('settings-store') }}",
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
                    $('#institutionError').text(res.responseJSON.errors.institution);
                    $('#lga_deptsError').text(res.responseJSON.errors.lga_depts);
                    $('#emailError').text(res.responseJSON.errors.email);
                    $('#phoneError').text(res.responseJSON.errors.phone);
                    $('#centerError').text(res.responseJSON.errors.center);
                    $('#imageError').text(res.responseJSON.errors.image);

                }
            });
        });
        $('#addEditOrgForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $("#btn-save").html('Please Wait...');
            $("#btn-save"). attr("disabled", true);
            // ajax
            $.ajax({
                type:"POST",
                enctype: 'multipart/form-data',
                url: "{{ url('settings-store') }}",
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
                    $('#institutionError').text(res.responseJSON.errors.institution);
                    $('#lga_deptsError').text(res.responseJSON.errors.lga_depts);
                    $('#emailError').text(res.responseJSON.errors.email);
                    $('#phoneError').text(res.responseJSON.errors.phone);
                    $('#centerError').text(res.responseJSON.errors.center);
                    $('#imageError').text(res.responseJSON.errors.image);

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

{{--THE END- CREATING A NEW Setting--}}
