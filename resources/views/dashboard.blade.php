@extends('layouts/layout')

@section('content')
<div class="container-fluid">


    <!-- STUDENTS -->
@if(Auth::user()->usertype_id == 2)
    <div class="container p-2" style="background-color: white;">
        <div class="row mb-3">
            <div class="col-xl-8 col-md-12">
                <div class="card" style="background-color: #169b6b;">
                    <div class="card-body">
                        <h4 class="card-title" style="font-weight: bold; color: white;">Welcome {{ Auth::user()->name }}</h4>
                        <a href="{{ route('students.mycourses', Auth::user()->id) }}"
                           class="btn btn-outline-light">View Class</a>
                        <a href="{{ route('assignments.mine', Auth::user()->id) }}"
                           class="btn btn-outline-light">View My Assignments</a>
                        <br>
                        <br>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-12">
                <div class="card" style="background-color: yellow;">
                    <div class="card-body center-items">
                        <h5 class="card-title" style="font-weight: bold; color: black;">Your Progress</h5>

                        @if($student)
                        <p> You have attended <strong>{{ $student->student_total_attendance }}</strong> out of <strong>{{ $student->expected_attendance }}</strong> Classes</p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: {{ round(((int)$student->student_total_attendance * 100) / (int)$student->expected_attendance), 2 }}%" aria-valuenow="{{ round(((int)$student->student_total_attendance * 100) / (int)$student->expected_attendance), 2 }}" aria-valuemin="0" aria-valuemax="100">{{ round(((int)$student->student_total_attendance * 100) / (int)$student->expected_attendance), 2 }}%</div>
                        </div>
                        @else
                            <p> No Classes yet</p>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if(is_null($studentmentorship))
                <div class="col-xl-8 col-xs-12">
                    <h5 style="font-weight: bold">Available Mentors
                        <a href="#" class="float-right" style="font-weight: bold; font-size: 12px">See more</a>
                    </h5>

                    <div class="row">
                        @if($mentors)
                            @foreach($mentors as $mentor)
                                <div class="col-xs-12 col-xl-4">
                                    <div class="card h-100" style="margin-bottom: 10px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); text-align: center;">
                                        <img src="{{ asset('/storage/imgs/'. $mentor->users->photo) }}" height="200px" width="140px" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <a href="#">   <p class="card-title" style="font-weight: bold;">{{ $mentor->users->name }}</p></a>
                                            <p class="card-text">{{ $mentor->area }}</p>
                                            <p class="card-text">{{ $mentor->company }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @else
                <div class="col-xl-8 col-xs-12">
                    <div class="row">
                        <div class="col-xs-12 col-xl-4">
                            <div class="card h-100" style="margin-bottom: 10px;
                                text-align: center;">
                                <img src="{{ asset('/storage/imgs/'. $studentmentorship->mentorusers->photo) }}" height="200px" width="140px" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="#">   <p class="card-title" style="font-weight: bold;">{{ $studentmentorship->mentorusers->name }}</p></a>
                                    <hr style="border: solid green .5px">
                                    <label style="background-color: orange; padding:5px; color:#272626; border-radius: 5px">{{ $studentmentorship->mentors->position }}</label>
                                    <p class="card-text"style="color:#272626;">{{ $studentmentorship->mentors->company }}</p>
                                    <h5 class="card-text"style="color:#272626; font-weight: bold;">Your Mentor</h5>

                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-xl-8">
                            <div class="card h-100" style="margin-bottom: 10px;
                                    text-align: left;">
                                <div class="card-body">
                                    <a href="#">   <p class="card-title" style="font-weight: bold;">{{ $studentmentorship->mentorusers->name }}</p></a>
                                    <p class="card-text">Your Mentor is the {{ $studentmentorship->mentors->position }} of {{ $studentmentorship->mentors->company }},
                                    located at {{ $studentmentorship->mentors->address }}.</p>
                                    <p class="card-text" style="color: grey; font-weight: bold;">You can reach him on the following:</p>
                                    <h6>Email:  <p style="font-style: italic; font-weight: bold;">{{ $studentmentorship->mentorusers->email }}</p></h6>
                                    <h6>Phone:  <p style="font-style: italic; font-weight: bold;">{{ $studentmentorship->mentorusers->phone }}</p></h6>
                                    <hr style="border: solid 1px darkgreen">
                                    <h5 style="font-weight: bold; color: grey;">Mentoring and Evaluation</h5>
                                    <h6>Start Date:  <span style="font-style: italic; font-weight: bold;">{{ $studentmentorship->start_date }}</span></h6>
                                    <h6>End Date:  <span style="font-style: italic; font-weight: bold;">{{ $studentmentorship->end_date }}</span></h6>
                                    <h6>Duration:  <span style="font-style: italic; font-weight: bold;">{{ $studentmentorship->duration }} months</span></h6>

                                </div>
                            </div>
                        </div>
                </div>
                </div>
            @endif

            <div class="col-xl-4 col-md-12">
                <h5 style="font-weight: bold">Activities</h5>
                <div class="card" style="border: 1px solid;">
                    <div class="card-body center-items">
                        @if($subjects)
                            @foreach($subjects as $subject)
                        <div class="card pt-2" style="border: 1px solid; margin: 5px">
                            <p style="font-weight: bold; padding: 10px">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-green"></i>
                                {{ $subject->subjects->title }} <span style="color: green; font-style: italic;"> Completed!</span></p>
                        </div>
                            @endforeach
                        @else
                            <div class="card pt-2" style="border: 1px solid; margin: 5px">
                                <p style="font-weight: bold; padding: 10px">
                                    No Classes attended yet
                                </p>
                            </div>
                            @endif
                            <div class="card pt-2" style="border: 1px solid; margin: 5px; background-color: red; text-align: center">
                                <p style="font-weight: bold; padding: 10px">
                                    @if($student)
                                    <span style="color:white; font-style: italic;"> {{ $student->status }}</span></p>
                                @else
                                    <span style="color:white; font-style: italic;"> Not yet assigned to a Mentor</span></p>

                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- ADMINISTRATORS -->
@if(Auth::user()->roles->first()->id == 1)
        <div class="container p-5 bg-white">
            <div class="row mb-3">
                <div class="col-xl-8 col-md-12">
                    <div class="card bg-white" style="height: 254px">
                <div class="card-body center-items">
                    <canvas id="firstChart" style="width:100%; height:235px;">
                    </canvas>
                </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12">
                    <div class="card" style="background-color: white;">
                        <div class="card-body center-items">
                            <h6 class="card-title" style="color: #036f06;">Total Users</h6>
                            <p style="font-wieght: bold">{{$users->count()}}</p>
                            <h6 class="card-title" style="color: #036f06;">Total Mentee</h6>
                            <p style="font-wieght: bold">{{ $mentee->count() }}</p>
                            <h6 class="card-title" style="color: #036f06;">Total Mentors</h6>
                            <p style="font-wieght: bold">{{ $all_mentors->count() }}</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-xs-12 bg-white pl-1">
                    <h5 style="font-weight: bold">New Mentees
                        <a href="{{ route('students.index') }}" class="float-right" style="font-weight: bold; font-size: 12px; padding-top: 10px"> >>See more</a>
                    </h5>

                    <div class="row pl-2">
                        <table class="table table-striped">
                            <thead>
                            <th>Student No.</th>
                            <th>Course</th>
                          {{--  <th>Email</th>--}}
                            </thead>
                            <tbody>
                            @foreach($all_students as $student)
                                <tr>
                                    <td>{{ $student->student_no }}</td>
                                    <td>{{ $student->courses->title }}</td>
                                   {{-- <td>{{ $student->users->email }}</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 bg-white">
                    <h5 style="font-weight: bold">User Type</h5>
                    <div class="card">
                        <div class="card-body center-items">
                            <canvas id="myChart" style="width:100%; height:250px;">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endif

<!-- MENTORS -->
@if(Auth::user()->usertype_id == 3)
        <div class="container p-2" style="background-color: white;">
            <div class="row col-md-12 mb-1">
                <div class="col-md-4 text-center">
                    <div class="card shadow mb-5 rounded" style="background-color: #169b6b; color: white;">
                        <div class="card-body">
                            <p class="card-title" style="font-weight: bold;">Total No. of Mentees</p>
                            @if($mentees == null)
                            <h4>0</h4>
                            @else <h4>{{ count($mentees) }}</h4>
                                @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="card" style="background-color: #169b6b; color: white;">
                        <div class="card-body">
                            <p class="card-title" style="font-weight: bold;">Mentees on Mentorship</p>
                            <h4>0</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="card" style="background-color: #169b6b; color:white">
                        <div class="card-body">
                            <p class="card-title" style="font-weight: bold;">Total No. of Mentees Graduated</p>
                            <h4>0</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row col-md-12">
                <div class="col-md-12">
                    <h6 style="color: green; font-weight: bold">Mentees List
                        <span class="float-right"><a href="{{ route('mentorships.mymentees') }}">View All</a></span>
                    </h6>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Mentee No.</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Expected Assignments</th>
                            <th scope="col">Assignments Done</th>
                            <th scope="col">Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($mentees)
                        @foreach($mentees as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->users->name }}</td>
                            <td>{{ $d->student_no }}</td>
                            <td>{{ $d->start_date }}</td>
                            <td>{{ $d->end_date }}</td>
                            <td>{{ $d->total_assignment_expected }}</td>
                            <td>{{ $d->assignment_done }}</td>
                            <td>{{ $d->status->status }}</td>
                            <td>
                                <div class="btn-group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-three-dots-vertical dropdown-toggle" data-bs-toggle="dropdown" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    </svg>
                                    <ul class="dropdown-menu pl-3 ">
                                        <li style="padding-bottom: 3px"><a href="{{ route('assignments.create') }}" class="View" data-id="{{ $d->id }}" style="text-decoration: none; color:#4e4c4c"><i class="fa fa-eye"></i> Give Assignment</a></li>
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

            <div class="row col-md-12">
                <div class="col-md-12">
                    <h6 style="color: green; font-weight: bold">Assignment Awaiting your Action
                        <span class="float-right"><a href="{{ route('assignments.mentorsview') }}">View All</a></span>
                    </h6>
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student No.</th>
                            <th scope="col">Assignment No.</th>
                            <th scope="col">status</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>

                        </tr>
                        </thead>
                        <tbody>
                        @if($submissions)
                            @foreach($submissions as $d)
                        <tr>
                            @if($d->status == 2)
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->student_no }}</td>
                            <td>{{ $d->assignments->ass_no }}</td>
                            <td><label style="background-color: yellow; color: black;
                            padding-left: 5px; padding-right: 5px;">{{ $d->statuses->status }}</label></td>
                            <td>{{date('d-m-Y', strtotime($d->created_at))}}</td>
                            <td> <button class="btn btn-info btn-sm" style="background-color: #267628; border: none;">
                                    <a style="color: white; text-decoration: none;" class="edit" href="{{ route('submissions.edit', $d->id) }}"
                                       data-id="{{ $d->id }}"><i class="fa fa-pencil"></i> Review </a></button></td>
                            @endif
                        </tr>
                            @endforeach
                         @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endif


</div>

@endsection

    @section('scripts')

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('/vendor/chart.js/Chart.min.js') }}"></script>
      {{--  <script type="text/javascript">
            var _labels = {!! json_encode($labels) !!}
            var _data = {!! json_encode($data) !!}

            var _plabels = {!! json_encode($plabels) !!}
            var _pdata = {!! json_encode($pdata) !!}

        </script>--}}

        <!-- Page level custom scripts -->
        <script src="{{ asset('/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('/js/demo/chart-pie-demo.js') }}"></script>

{{--        <script src="http://code.highcharts.com/highcharts.js"></script>--}}
{{--        <script src="http://code.highcharts.com/modules/exporting.js"></script>--}}
        <script type="text/javascript">
          var ctx = document.getElementById("myChart");
          var myChart = new Chart(ctx, {
            type: 'doughnut',
              data: {
                  labels: [
                      'Managers','Mentee','Mentors'
                  ],
                  datasets: [{
                      label: 'Data Summary',
                      data: {!!  $data !!},
                      backgroundColor: [
                          'rgb(255, 99, 132)',
                          'rgb(54, 162, 235)',
                          'rgb(255, 205, 86)'
                      ],
                      hoverOffset: 4
                  }]
              }
          });
        </script>
        <script type="text/javascript">
            var ctx1 = document.getElementById("firstChart");
            var myChart1 = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: [10, 50, 70, 100, 150, 170, 200],
                    datasets: [{
                        label: 'Data Summary',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.3,

                    }]},

            });
        </script>
        @endsection

