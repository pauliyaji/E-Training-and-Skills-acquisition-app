@extends('layouts.layout')

@section('content')
    <style>
        .profile-content-right{
            border-top: 0px;
            border-left: 1px solid #15b519;
        }
        .nav-tabs {
            border-bottom: 1px solid #15b519;
        }

    </style>
    <div class="content m-10">
        <div class="bg-white border rounded m-5">
            <div class="row no-gutters">
                <div class="col-lg-5 col-xl-3">
                    <div class="profile-content-left pt-5 pb-1 px-3 px-xl-5">
                        <div class="card text-center widget-profile px-0 border-0">
                            <div class="card-img mx-auto rounded-circle">
                                <img src="{{ asset('storage/imgs/'.$data->photo) }}" height="200px" weight="200px" alt="user image">
                            </div>
                            <div class="card-body">
                                <h6 style="font-weight: bold" class="py-2 text-dark">{{ $data->name }}</h6>
                                <p style="color: green;">{{ $mentor->id }}</p>

                            </div>
                        </div>
                        <div class="contact-info pt-4 text-center">
                            <h5 class="text-light mb-1" style="background-color: #0f6848">Contact Information</h5>
                            <p class="text-dark font-weight-medium pt-4 mb-2">Email address</p>
                            <p>{{ $data->email }}</p>
                            <p class="text-dark font-weight-medium pt-4 mb-2">Phone Number</p>
                            <p>{{ $data->phone }}</p>

                        </div>

                    </div>
                </div>
                <div class="col-lg-7 col-xl-9">
                    <div class="profile-content-right py-5">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"
                                        style="color: green;">AccountSettings</button>
                            </li>
                            <li class="nav-item text-green" role="presentation">
                                <button style="color: green;" class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Security</button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="tab-content px-3 px-xl-5" id="myTabContent">
                                    <div class="mt-5">
                                        <form action="{{ route('mentors.profileupdate', $data->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <div class="form-group row mb-6">
                                                <label for="photo" class="col-sm-4 col-lg-2 col-form-label">User Image</label>
                                                <div class="col-sm-8 col-lg-10">
                                                    <div class="custom-file mb-1">
                                                        <input type="file" class="custom-file-input" id="photo" name="photo">
                                                        <label class="custom-file-label" for="photo">Choose file...</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="firstName">Full name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="userName">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone }}">
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="lga_depts">L.G.A / Department</label>
                                                <select class="form-control"
                                                        name="lga_depts" readonly>
                                                    <option value="">Select LGA/Department</option>
                                                    @foreach($lgas as $lga)
                                                        <option  @if($mentor->lga_depts==$lga->title) selected @endif value="{{ $lga->title }}"
                                                            {{$lga->title}}>{{ $lga->title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('lga_depts')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="d-flex justify-content-end mt-5">
                                                <button type="submit" class="btn btn-primary mb-2 btn-pill">Update Profile</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="tab-content px-3 px-xl-5" id="myTabContent">
                                    <div class="mt-5">
                                        <form action="{{ route('mentors.passwordupdate', $data->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <div class="form-group mb-4">
                                                <label for="newPassword">New password</label>
                                                <input type="password" class="form-control" name="password" id="password" value="" />
                                                <p class="help-block"></p>
                                                @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="confPassword">Confirm password</label>
                                                <input class="form-control" id="password" type="password" name="password_confirmation">
                                                <p class="help-block"></p>
                                            </div>
                                            <div class="d-flex justify-content-end mt-5">
                                                <button type="update" class="btn btn-primary mb-2 btn-pill">Update Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="tab-content px-3 px-xl-5" id="myTabContent">
                                    <div class="mt-5">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Batch</th>
                                                    <th>Mentee</th>
                                                    <th>Course</th>
                                                    <th>Period</th>
                                                    <th>Date</th>
                                                    <th>Attendance</th>
                                                </tr>
                                                </thead>

                                                <tbody>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                                <div class="tab-content px-3 px-xl-5" id="myTabContent">
                                    <div class="mt-5">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable">

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@stop
