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
                <h6 class="m-0 font-weight-bold text-primary">Admin
                    <a href="{{ route("users.create") }}" class="float-right btn btn-success btn-sm">Add New</a>
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
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th></th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if($users)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email  }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="btn btn-success btn-sm btn-block">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success"
                                               data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                               data-off="Blocked" {{ $user->status ? 'checked' : '' }} >
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical dropdown-toggle" data-bs-toggle="dropdown" viewBox="0 0 16 16">
                                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                </svg>

                                            <ul class="dropdown-menu pl-3 ">
                                               <li style="padding-bottom: 3px"> <a href="{{ route('users.show', $user->id) }}" style="text-decoration: none; color:#4e4c4c;"><i class="fa fa-eye"></i> View</a></li>
                                                <li style="padding-bottom: 3px"><a href="{{ route('users.edit', $user->id) }}" style="text-decoration: none; color:#4e4c4c"><i class="fa fa-edit"></i> Edit</a></li>
                                                <li style="padding-bottom: 3px"><a onclick="return confirm('Are you sure you want to delete this data?')"
                                                   href="{{ route('users.destroy', $user->id) }}" style="text-decoration: none; color:#4e4c4c">
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

<script>
    $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });
</script>


<script>

        $(document).ready(function () {

            $('#dataTable').on( 'change', 'input.toggle-class', function () {
                //console.log($(this).prop( 'checked' ) ? 1 : 0 );
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: 'http://localhost/skills-acquisition/public/users/changeStatus',
                    data: {'status': status, 'user_id': user_id},
                    success: function(data){
                        swal('Success', 'Status Changed Successfully','success',
                        );
                    }
                });
            } );

        });
</script>

