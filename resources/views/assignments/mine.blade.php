
@extends('layouts/layout')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All My Assignments</h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Assignment No.</th>
                            <th>Description</th>
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
                                    <td>{{date('d-m-Y', strtotime($d->created_at))}}</td>
                                    <td style="background-color: #e36403; color: white">{{ $d->statuses->status }}</td>
                                    <td>
                                        @if($d->status == 1)
                                        <a href="{{ route('submissions.makesubmission', $d->id) }}">
                                    <button class="btn btn-primary btn-sm">Make a Submission</button></a>
                                   @endif
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


