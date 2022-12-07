
@extends('layouts/layout')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Assignments By <h6>{{ Auth::user()->name }}</h6>
                    <a href="{{ route("assignments.create") }}" class="float-right btn btn-success btn-sm">Add New</a>
                </h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Assignment No.</th>
                            <th>Description</th>
                            <th>Student No.</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data)
                            @foreach($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->ass_no }}</td>
                                    <td>{{ $d->description }}</td>
                                    <td>{{ $d->student_no }}</td>
                                    <td>{{date('d-m-Y', strtotime($d->created_at))}}</td>
                                    <td>{{ $d->statuses->status }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical dropdown-toggle" data-bs-toggle="dropdown" viewBox="0 0 16 16">
                                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>
                                            <ul class="dropdown-menu pl-3 ">
                                                <li style="padding-bottom: 3px"><a href="{{ route('assignments.edit', $d->id) }}" style="text-decoration: none; color:#4e4c4c"><i class="fa fa-edit"></i> Edit and Send</a></li>
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


