@extends('layouts/layout')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Settings
                    @if($settings->count() > 0)
                    <a href="{{ url()->previous() }}" class="float-right btn btn-success btn-sm"><i class="fa fa-undo"></i> Back</a>
                    @else
                        <a href="{{ route('settings.create') }}">
                            <button type="button" class="btn btn-success btn-flat add_new_settings float-right" data-name="">
                                <i class="fa fa-plus-circle text-white fa-lg"></i> Enter your settings</button>
                        </a>
                    @endif
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
                                        <button class="btn btn-success btn-sm" style="background-color: #1e744b;">
                                            <a style="color: white; text-decoration: none;" class="edit" href="javascript:void(0)"
                                               data-id="{{ $setting->id }}"><i class="fa fa-edit"></i> Edit your Settings </a></button>
                                 </td>
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
                            <div class="card bg-white col-md-12" style="padding: 10px; margin-bottom: 40px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                {!! Form::open(['method' => 'POST', 'route' => ['settings-store'], 'enctype'=>'multipart/form-data']) !!}
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name of Company/Organisation</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="institution" name="institution" placeholder="Enter Institution" value="" required>
                                        <span class="text-danger" id="centerError"></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Center Location</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="center" name="center" placeholder="Enter Center/Location" value="" required>
                                        <span class="text-danger" id="centerError"></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Official Email</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter official email" value="" required>
                                        <span class="text-danger" id="emailError"></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Official Phone</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="" required>
                                        <span class="text-danger" id="phoneError"></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <div class="col-sm-12">
                                    <textarea id="description" name="description" rows="4">

                                    </textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload your logo</label>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control" id="image" name="image" value="">
                                        <span class="text-danger" id="imageError"></span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="col-sm-12">
                                        <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                             alt="preview image" style="max-height: 250px;">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

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
                    $('#id').val(res.message.id);
                    $('#institution').val(res.message.institution);
                    $('#lga_depts').val(res.message.lga_depts);
                    $('#center').val(res.message.center);
                    $('#email').val(res.message.email);
                    $('#phone').val(res.message.phone);
                    $('#address').val(res.message.address);
                    $('#description').val(res.message.description);
                    $('#image').val(res.message.image);

                }
            });
        });
        $('body').on('click', '.delete', function () {
            if (confirm("Delete Record?") == true) {
                var id = $(this).data('id');
                alert(id);
                // ajax
                $.ajax({
                    type:"POST",
                    url: "{{ url('delete-settings') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                        console.log(res.message);
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
