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
                                <p style="color: green;">{{ $student->student_no }}</p>

                            </div>
                        </div>
                        <div class="contact-info pt-4 text-center">
                            <h5 class="text-light mb-1" style="background-color: #0f6848">Contact Information</h5>
                            <p class="text-dark font-weight-medium pt-4 mb-2">Email address</p>
                            <p>{{ $data->email }}</p>
                            <p class="text-dark font-weight-medium pt-4 mb-2">Phone Number</p>
                            <p>{{ $data->phone }}</p>

                        </div>
                        <div class="contact-info pt-4 text-center">
                            <h5 class="text-light mb-1" style="background-color: #0f6848">Course Information</h5>
                            <p class="text-dark font-weight-medium pt-4 mb-2">Vocational Skill</p>
                            <p>{{ $student->courses->title }}</p>
                            <p class="text-dark font-weight-medium pt-4 mb-2">L.G.A/Department</p>
                            <p>{{ $student->lga_depts }}</p>

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
                            <li class="nav-item" role="presentation">
                                <button style="color: green;" class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Attendance</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button style="color: green;" class="nav-link" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" type="button" role="tab" aria-controls="contact" aria-selected="false">Class Summary</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="tab-content px-3 px-xl-5" id="myTabContent">
                                    <div class="mt-5">
                                        <form action="{{ route('students.profileupdate', $data->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('patch')
                                            <div class="form-group row mb-6">
                                                <label for="photo" class="col-sm-4 col-lg-2 col-form-label">User Image</label>
                                                <div class="col-sm-8 col-lg-10">
                                                    <div class="custom-file mb-1">
                                                        <input type="file" class="custom-file-input" id="photo" name="photo">
                                                        <label class="custom-file-label" for="photo">Choose file...</label>
                                                        {{-- <div class="invalid-feedback">Example invalid custom file feedback</div>--}}
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
                                                        <option  @if($student->lga_depts==$lga->title) selected @endif value="{{ $lga->title }}"
                                                            {{$lga->title}}>{{ $lga->title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('lga_depts')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="course_id">Course</label>
                                                <select class="form-control"
                                                        name="course_id" readonly>
                                                    <option value="">Select Course</option>
                                                    @foreach($courses as $course)
                                                        <option  @if($student->course_id==$course->id) selected @endif value="{{ $course->id }}"
                                                            {{$course->title}}>{{ $course->title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('course_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-4">
                                                {!! Form::label('location_id', 'Center Location', ['class' => 'control-label']) !!}
                                                <select class="form-control" name="center_location" id="location-dropdown"
                                                        readonly > <option value="">Select Center Location</option>
                                                    @foreach($locations as $location)
                                                        <option  @if($student->center_location==$location->id) selected @endif value="{{ $location->id }}"
                                                            {{$location->location}}>{{ $location->location }}</option>
                                                    @endforeach
                                                </select>
                                                @error('location_id')
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
                                        <form action="{{ route('students.passwordupdate', $data->id) }}" method="post" enctype="multipart/form-data">
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
                                                @if($students)
                                                    @foreach($students as $student)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td><a href="#">{{ $student->batches->title }}</a></td>
                                                            <td>{{ $student->users->name, $student->students->student_no }}</td>
                                                            <td>{{ $student->courses->title }}</td>
                                                            <td>{{ $student->periods->period }}</td>
                                                            <td>{{ $student->date }}</td>
                                                            @if($student->present == 1)
                                                                <td><p style="color: #24c346;">&#10004</p></td>
                                                            @elseif($student->present == 0)
                                                                <td><p>&#10060;</p></td>
                                                            @endif
                                                        </tr>
                                                    @endforeach

                                                @endif
                                                </tbody>
                                                {{-- <tfoot style="background-color: #023054; color:white;">

                                                 <tr >

                                                     <th colspan="6" style="text-align: right;">TOTAL</th>
                                                     <th style="text-align:center"></th>
                                                 </tr>
                                                 </tfoot>--}}
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
                                               @if($summary)
                                                <tr>
                                                    <th>Batch</th>
                                                    <td><a href="#">{{ $summary->batches->title }}</a></td>
                                                </tr>
                                                <tr>
                                                    <th>Mentee</th>
                                                    <td>{{ $summary->users->name, $summary->students->student_no }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Course</th>
                                                    <td>{{ $summary->courses->title }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="color: green;">Attendance</th>
                                                    <td>{{ $summary->student_total_attendance }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="color: orange;">Expected Attendance</th>
                                                    <td>{{ $summary->expected_attendance }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="color: red;">Minimum Attendance</th>
                                                    <td>{{ $summary->minimum_attendance }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>{{ $summary->status }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Mentorship</th>
                                                    <td>
                                                        @if($summary->status == 'Completed')
                                                            <a href="{{ route('mentorships.add', $summary->id) }}">
                                                                <button type="button" id="addNewMentorship" class="btn btn-success btn-flat add_new_mentorships m-1" data-name="">
                                                                    <i class="fa fa-handshake text-white fa-lg"></i> Assign Mentor</button>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @else
                                                <tr style="color: red;">Not Assigned to any Batch yet</tr>
                                                   @endif
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
