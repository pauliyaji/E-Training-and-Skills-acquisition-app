
@extends('layouts/layout')

@section('content')
    {{--<livewire:styles />--}}

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div>
            <button class="btn btn-primary btn-sm">Attendance Register</button>
            <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm float-right"> <i class="fas fa-fw fa-undo"></i> Back</a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="row g-4 pt-5">
                     <div class="col-sm-3 m-1">
                         <input type="text" name="batch_id" class="form-control" value="{{ $batches->title }}" readonly>
                     </div>
                     <div class="col-sm-3 m-1">
                         <input type="text" name="course_id" class="form-control" value="{{ $courses->title }}" readonly>
                     </div>
                     <div class="col-sm-3 m-1">
                         <input type="text" name="subject_id" class="form-control" value="{{ $sub->title }}" readonly>
                     </div>
                     <div class="col-sm-2 m-1">
                         <input type="text" name="period_id" class="form-control" value="{{ $sessions->period }}" readonly>
                     </div>

                </div>

            </div>
            <div class="card-body">
                <form method="post" action="{{ route('attendance.submit') }}">
                     @csrf

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Mentee No.</th>
                            <th>Full Name</th>
                            <th>Present/Absent</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($studentInCart as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="#">{{ $student->student_no }}</a></td>
                                <td>{{ $student->users->name }}</td>
                                <td>
                                   {{-- <input type="hidden" name="batch_id[]" value="{{$student->batch_id }}">
                                    <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                    <input type="hidden" name="course_id[]" value="{{ $student->course_id }}">
                                    <input type="hidden" name="subject_id[]" value="{{ $student->subject_id }}">
                                    <input type="hidden" name="period_id[]" value="{{$student->period_id}}">
                                    <input type="hidden" name="user_id[]" value="{{$student->user_id}}">--}}

                                    <input data-id="{{$student->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                                           data-offstyle="danger" data-toggle="toggle" data-on="Present"
                                           data-off="Absent" {{ $student->present ? 'checked' : '' }} >
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-3 m-1 float-right">
                        <input type="date" name="date" value="" class="form-control float-right">
                    </div>
                </div>

                <div class="col-md-3 m-1 float-right">
                    <input type="submit" value="Submit Attendance" class=" form-control btn btn-primary btn-sm float-right" />
                </div>
                </form>
            </div>
        </div>

        <!-- Modal -->

    </div>
    <!-- /.container-fluid -->

@endsection

@include('layouts/footer')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#select2-dropdown').select2();
        $('#select2-dropdown').on('change', function (e) {
            var data = $('#select2-dropdown').select2("val");
            $("#select2-dropdown").val(data);
        });
        $('#course2-dropdown').select2();
        $('#course2-dropdown').on('change', function (e) {
            var data = $('#course2-dropdown').select2("val");
            $("#course2-dropdown").val(data);
        });
        $('#student2-dropdown').select2();
        $('#student2-dropdown').on('change', function (e) {
            var data = $('#student2-dropdown').select2("val");
            $("#student2-dropdown").val(data);
        });
        $('#subject2-dropdown').select2();
        $('#subject2-dropdown').on('change', function (e) {
            var data = $('#subject2-dropdown').select2("val");
            $("#subject2-dropdown").val(data);
        });
        $('#session2-dropdown').select2();
        $('#session2-dropdown').on('change', function (e) {
            var data = $('#session2-dropdown').select2("val");
            $("#session2-dropdown").val(data);
        });
    });
</script>

<script>

    $(document).ready(function () {
        $("#dataTable").DataTable()

        $(function(){
            $('.toggle-class').change(function(){
                var present = $(this).prop('checked') == true ? 1 : 0;
                var student_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: 'http://localhost/skills-acquisition/public/attendance/markRegister',
                    data: {'present': present, 'student_id': student_id},
                    success: function(data){
                        swal('Success', 'Status Changed Successfully','success',
                        );
                    }
                });
            })
        });
    });
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
