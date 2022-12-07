
@extends('layouts/layout')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Classes
                    <a href="{{ route('classes.summary') }}" class="btn btn-primary btn-sm float-right"> <i class="fas fa-fw fa-table"></i> Class Summary</a>
                </h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Batch</th>
                            <th>Course</th>
                            <th>Mentee</th>
                            <th>Session</th>
                           {{-- <th>Action</th>--}}

                        </tr>
                        </thead>
                        <tbody>
                        @if($classes)
                            @foreach($classes as $class)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $class->batches->title }}</td>
                                    <td>{{ $class->courses->title }}</td>
                                    <td><a href="{{ route('users.show', $class->students->user_id ) }}">{{ $class->students->student_no }}</a></td>
                                    <td>{{ $class->periods->period }}</td>
                                   {{-- <td>
                                            <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-edit"></i> Edit</a>
                                            <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Attendance</a>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                                    </td>--}}

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@endsection

@include('layouts/footer')


<!-- Bootstrap core JavaScript-->


