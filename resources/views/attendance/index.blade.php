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
                <h6 class="m-0 font-weight-bold text-primary">General Attendance Register
                    <a href="{{ route('attendance.summary')}}">
                        <button type="button" class="btn btn-success btn-flat add_new_batches m-1 float-right" data-name="">
                            <i class="fa fa-eye text-white fa-lg"></i> Attendance Summary </button>
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
                            <th>Batch</th>
                            <th>Mentee</th>
                            <th>Course</th>
                            <th>Period</th>
                            <th>Date</th>
                            <th>Attendance</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($students)
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->batches->title }}</></td>
                                    <td>{{ $student->users->name, $student->students->student_no }}</td>
                                    <td>{{ $student->courses->title }}</td>
                                    <td>{{ $student->periods->period }}</td>
                                    <td>{{ $student->date }}</td>
                                    @if($student->present == 1)
                                    <td><p style="color: #24c346;">&#10004</p></td>
                                    @elseif($student->absent)
                                    <td><p>&#10060;</p></td>
                                    @endif
                                </tr>
                            @endforeach

                        @endif
                        </tbody>
                       {{-- <tfoot style="background-color: #023054; color:white;">

                        <tr >

                            <th colspan="6" style="text-align: right;">TOTAL</th>
                            <th style="text-align:center"></th>
                        </tr>
                        </tfoot>--}}
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- boostrap model for Course -->

    </div>
    <!-- /.container-fluid -->

@endsection

@include('layouts/footer')


<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                // Total over all pages
                total1 = api
                    .column(6)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(6, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                               // Update footer
                $(api.column(6).footer()).html(parseFloat(pageTotal));
            },
        });
    });
</script>
{{--THE END- CREATING A NEW Course--}}


