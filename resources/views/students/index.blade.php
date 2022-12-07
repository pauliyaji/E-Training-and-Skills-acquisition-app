
@extends('layouts/layout')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Mentees
                    <a href="{{ route("students.create") }}" class="float-right btn btn-success btn-sm">Add New</a>
                </h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Mentee No.</th>
                            <th>Full Name</th>
                            <th>Institution/State</th>
                            <th>Vocational Skill</th>
                            <th>Date of Registration</th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                        @if($students)
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->student_no }}</td>
                                    <td>{{ $student->users->name }}</td>
                                    <td>{{ $student->institution }}</td>
                                    <td>{{ $student->courses->title }}</td>
                                    <td>{{ $student->created_at }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical dropdown-toggle" data-bs-toggle="dropdown" viewBox="0 0 16 16">
                                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>
                                            <ul class="dropdown-menu pl-3 ">
                                                <li style="padding-bottom: 3px"><a href="{{route('users.show', $student->user_id)}}" style="text-decoration: none; color:#4e4c4c"><i class="fa fa-eye"></i> View</a></li>
                                                <li style="padding-bottom: 3px"><a href="{{route('users.edit', $student->user_id)}}" style="text-decoration: none; color:#4e4c4c"><i class="fa fa-edit"></i> Edit Personal Info</a></li>
                                                <li style="padding-bottom: 3px"><a href="{{route('classes.studentadd', $student->id)}}" style="text-decoration: none; color:#4e4c4c"><i class="fa fa-plus-circle"></i> Add to Class</a></li>
                                                <li style="padding-bottom: 3px"><a href="#" style="text-decoration: none; color:#4e4c4c">
                                                        <i class="fa fa-trash"></i> Delete</a></li>
                                            </ul>

                                        </div>

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
    </div>
    <!-- /.container-fluid -->

@endsection

@include('layouts/footer')


<!-- Bootstrap core JavaScript-->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


