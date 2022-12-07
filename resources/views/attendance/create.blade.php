
@extends('layouts/layout')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
<div>
    <a href="{{ route('attendance.index')}}">
        <button type="button" id="addNewBatch" class="btn btn-success btn-flat add_new_batches m-1" data-name="">
            <i class="fas fa-fw fa-table"></i> General Attendance </button>
    </a>
</div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="{{ route('attendance.mark') }}" method="post">
                    @csrf
                    <div class="row g-4 pt-5">
                        <div class="col-sm-3 m-1">
                            <select name="batch_id" id="select2-dropdown" required class="form-control">
                                <option value="">Select Batch</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 m-1">
                            <select name="course_id" id="course2-dropdown" required class="form-control">
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 m-1">
                            <select name="subject_id" id="subject2-dropdown" required class="form-control">
                                <option value="">Select Subject</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2 m-1">
                            <select name="session_id" id="session2-dropdown" required class="form-control">
                                <option value="">Select Session</option>
                                @foreach($sessions as $session)
                                    <option value="{{ $session->id }}">{{ $session->period }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 m-1">
                            <input type="submit" value="Filter" class="btn btn-primary btn-sm btn-block" />
                        </div>

                    </div>

                </form>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Mentee No.</th>
                            <th>Full Name</th>
                            <th>Present</th>
                            <th>Absent</th>

                        </tr>
                        </thead>
                        <tbody>
                        {{--  @if($classes)
                              @foreach($classes as $class)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ $class->batches->title }}</td>
                                      <td>{{ $class->courses->title }}</td>
                                      <td><a href="#">{{ $class->students->student_no }}</a></td>
                                      <td>{{ $class->periods->period }}</td>
                                  </tr>
                              @endforeach
                          @endif--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
    <!-- /.container-fluid -->

@endsection

@include('layouts/footer')


<!-- Bootstrap core JavaScript-->
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
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

