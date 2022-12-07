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
                <h6 class="m-0 font-weight-bold text-primary">All Mentorships
                </h6>
            </div>
            <div class="card-body">
                {{--  @if(Session::has('success'))
                      <p class="text-success">{{ Session('success') }}</p>
                  @endif--}}

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Mentee</th>
                            <th>Student No.</th>
                            <th>email</th>
                            <th>phone</th>
                            <th>Duration</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($data)
                            @foreach($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->users->name }}</td>
                                    <td>{{ $d->student_no }}</td>
                                    <td>{{ $d->users->email }}</td>
                                    <td>{{ $d->users->phone }}</td>
                                    <td>{{ $d->duration }} months</td>
                                    <td>{{ $d->start_date }}</td>
                                    <td>{{ $d->end_date }}</td>
                                    @if($d->mentorship_status_id == '1')
                                        <td>{{ $d->status->status }}</td>
                                    @else
                                        <td><span class="btn btn-warning btn-sm">{{ $d->status->status }}</span></td>
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-three-dots-vertical dropdown-toggle" data-bs-toggle="dropdown" viewBox="0 0 16 16">
                                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>
                                            <ul class="dropdown-menu pl-3 ">
                                                <li style="padding-bottom: 3px"><a href="{{ route('assignments.create') }}" class="View" data-id="{{ $d->id }}" style="text-decoration: none; color:#4e4c4c"><i class="fa fa-eye"></i> Give Assignment </a></li>
                                                <li style="padding-bottom: 3px"><a href="{{ route('mentorships.edit', $d->id) }}" class="edit" data-id="{{ $d->id }}" style="text-decoration: none; color:#4e4c4c"><i class="fa fa-edit"></i> Edit</a></li>

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
        <!-- boostrap model for Course -->
    </div>
    <!-- /.container-fluid -->

@endsection

@include('layouts/footer')


<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#select2-dropdown').select2();
        $('#select2-dropdown').on('change', function (e) {
            var data = $('#select2-dropdown').select2("val");
            $("#select2-dropdown").val(data);
        });
    });
</script>

{{--THE END- CREATING A NEW Course--}}


