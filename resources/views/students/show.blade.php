@extends('layouts/layout')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="m-2">
                    <h4 class="m-1 pt-1 font-weight-bold text-primary">{{ $data->name }}'s Profile
                        <a href="{{ route('students.index') }}" class="float-right btn btn-success btn-sm mb-2">View All</a>
                    </h4>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>

        <div>

        </div>
        <div class="card shadow mb-4">
            <div class="row flex-container">
                <div class="col-md-6" style="margin-left: 10px; margin-right: 40px; margin-top: 5px; margin-bottom: 10px;">

                    <h6 style="margin-left: 10px;">PERSONAL INFORMATION</h6>
                    <div class="row col-xs-12" style="display: flex; padding-right: 20px">
                        <div class="col-md-3 col-xs-12 float-left" style="margin-right: 10px; margin-left: 10px;">
                            <img src="{{ asset('/storage/imgs/'. $data->photo) }}" width="200px" height="200px">
                        </div>
                        <div class="col-md-8 col-xs-12 float-right" style="margin-left: 10px; margin-right: 10px;">
                            <h3 style="font-weight: bold;">{{ $data->name }}</h3>
                            <p style="font-size: 16px">{{ $data->email }}</p>
                            <p style="font-size: 16px">{{ $data->phone }}</p>
                            @if($data->status == 1)
                            <p class="btn btn-primary btn-sm">Active</p>
                            @else
                                <p class="btn btn-danger btn-sm">Blocked</p>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-md-4" style="margin-right: 20px; margin-top: 5px; margin-left: 15px;">
                    <h6 style="padding: 5px;">ACCOUNT INFORMATION</h6>

                    <div style="display: flex; padding:5px;">
                        <div class="col-md-10 col-xs-12 m-0 p-0">
                            <br/>

                                <p style="font-size: 14px; font-weight: bold;">State: <span style="font-weight: normal">{{ $profile->institution }}</span></p>
                                <p style="font-size: 14px; font-weight: bold;">L.G.A: <span style="font-weight: normal">{{ $profile->lga_depts }}</span></p>
                                <p style="font-size: 14px; font-weight: bold;">Vocational Skills: <span style="font-weight: normal">{{ $profile->courses->title }}</span></p>
                                <p style="font-size: 14px; font-weight: bold;">Participatory Category: <span style="font-weight: normal">{{ $data->usertypes->type }}</span></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <h2>the next line</h2>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

@include('layouts/footer')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>



