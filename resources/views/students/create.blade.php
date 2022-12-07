@extends('layouts/layout')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['students.store'], 'enctype'=>'multipart/form-data']) !!}
    @csrf
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Mentee
                    <a href="{{ route('students.index') }}" class="btn btn-success btn-sm float-right">View All</a>
                </h6>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <p class="text-success">{{session('success')}}</p>
                @endif
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('name', 'Full Name', ['class' => 'control-label']) !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('lga_depts', 'LGA/Department', ['class' => 'control-label']) !!}
                            <select class="form-control"
                                    name="lga_depts" required>
                                <option value="">Select LGA/Department</option>
                                @foreach($lgas as $lga)
                                    <option value="{{ $lga->title }}"
                                        {{$lga->title}}>{{ $lga->title }}</option>
                                @endforeach
                            </select>
                            @error('lga_depts')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                        {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('phone', 'Phone No.', ['class' => 'control-label']) !!}
                            {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                            <input type="password" class="form-control" name="password" id="password" value=""  required/>
                            <p class="help-block"></p>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('password', 'Confirm Password', ['class' => 'control-label']) !!}
                            <input class="form-control" id="password" type="password" name="password_confirmation" required>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('course_id', 'Vocational Skill of Interest', ['class' => 'control-label']) !!}

                            <select class="form-control"
                                    name="course_id" required>
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{$course->title}}>{{ $course->title }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('location_id', 'Center Location', ['class' => 'control-label']) !!}
                            <select class="form-control" name="location_id" id="location-dropdown"
                                    required> <option value="">Select Center Location</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}"
                                        {{$location->location}}>{{ $location->location }}</option>
                                @endforeach
                            </select>
                            @error('location_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            <label>Passport Photo</label>
                            <input type="file" name="photo" id="photo" value="" class="form-control" />
                            @error('photo')
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
                $('#select2-dropdown').select2();
                $('#select2-dropdown').on('change', function (e) {
                    var data = $('#select2-dropdown').select2("val");
                    $("#select2-dropdown").val(data);
                });
                $('#location-dropdown').select2();
                $('#location-dropdown').on('change', function (e) {
                    var data = $('#location-dropdown').select2("val");
                    $("#location-dropdown").val(data);
                });
            });
        </script>

@stop
