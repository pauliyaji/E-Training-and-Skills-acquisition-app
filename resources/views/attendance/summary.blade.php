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
                <h6 class="m-0 font-weight-bold text-primary">General Attendance Summary
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
                            <th style="color: green;">Attendance</th>
                            <th style="color: orange;">Expected Attendance</th>
                            <th style="color: red;">Minimum Attendance</th>
                            <th>Status</th>
                            <th>Mentorship</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($data)
                            @foreach($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->batches->title }}</a></td>
                                    <td>{{ $d->users->name, $d->students->student_no }}</td>
                                    <td>{{ $d->courses->title }}</td>
                                    <td>{{ $d->student_total_attendance }}</td>
                                    <td>{{ $d->expected_attendance }}</td>
                                    <td>{{ $d->minimum_attendance }}</td>
                                    <td>{{ $d->status }}</td>
                                    <td>
                                        @if($d->status == 'Completed')
                                            <a href="{{ route('mentorships.add', $d->id) }}">
                                                <button type="button" id="addNewMentorship" class="btn btn-primary btn-flat add_new_mentorships" data-name="">
                                                    <i class="fa fa-handshake text-white fa-lg"></i> Assign Mentor</button>
                                            </a>
                                        @elseif($d->status == 'Assigned to Mentor')
                                            <a href="{{ route('mentorships.add', $d->id) }}">
                                                <button type="button" class="btn btn-success btn-flat" data-name="">
                                                    <i class="fa fa-handshake text-white fa-lg"></i> Already Assigned to a Mentor</button>
                                            </a>
                                        @endif
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

    </div>
    <!-- /.container-fluid -->

@endsection

@include('layouts/footer')


<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>



