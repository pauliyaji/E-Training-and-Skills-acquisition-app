@extends('layouts/layout')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['classes.store'], 'enctype'=>'multipart/form-data']) !!}
    @csrf
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Class
                    <a href="{{ route('classes.index') }}" class="btn btn-success btn-sm float-right">View All</a>
                </h6>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <p class="text-success">{{session('success')}}</p>
                @endif
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('batch_id', 'Batch', ['class' => 'control-label']) !!}
                        {!! Form::text('batch_id', $batches->title, ['class' => 'form-control', 'placeholder' => '', 'readonly'=>'']) !!}
                        <p class="help-block"></p>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('course_id', 'Vocational Skill/Course', ['class' => 'control-label']) !!}

                            <select class="form-control" name="course_id" id="course-dropdown">
                                required> <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{$course->id}}>{{ $course->title }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('student_id', 'Mentee', ['class' => 'control-label']) !!}
                            <select class="form-control" name="student_id" id="student-dropdown">
                                    required> <option value="">Select Mentee</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}"
                                        {{$student->id}}>{{ $student->users->name }}</option>
                                @endforeach
                            </select>
                            @error('student_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('period_id', 'Session', ['class' => 'control-label']) !!}
                            <select class="form-control" name="period_id" id="period-dropdown">
                                required> <option value="">Select Mentee</option>
                                @foreach($periods as $period)
                                    <option value="{{ $period->id }}"
                                        {{$period->id}}>{{ $period->period }}</option>
                                @endforeach
                            </select>
                            @error('period_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                <div class="row">
                    <div class="col-md-12 col-xs-4 form-group">
                        {!! Form::submit('Save', ['class' => 'btn btn-danger btn-sm']) !!}
                    </div>
                </div>
            </div>
        </div>

    {!! Form::close() !!}
    @include('layouts/footer')
    <!-- Bootstrap core JavaScript-->
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#period-dropdown').select2();
                $('#period-dropdown').on('change', function (e) {
                    var data = $('#period-dropdown').select2("val");
                    $("#period-dropdown").val(data);
                });
                $('#course-dropdown').select2();
                $('#course-dropdown').on('change', function (e) {
                    var data = $('#course-dropdown').select2("val");
                    $("#course-dropdown").val(data);
                });
                $('#student-dropdown').select2();
                $('#student-dropdown').on('change', function (e) {
                    var data = $('#student-dropdown').select2("val");
                    $("#student-dropdown").val(data);
                });
            });
        </script>
        @stop


