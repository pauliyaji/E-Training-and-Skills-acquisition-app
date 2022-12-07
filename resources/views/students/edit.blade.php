@extends('layouts/layout')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['students.update', $student->id], 'enctype'=>'multipart/form-data']) !!}
    @csrf
    @method('patch')
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update Mentee
                    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm float-right"> <i class="fas fa-fw fa-undo"></i> Back</a>
                </h6>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <p class="text-success">{{session('success')}}</p>
                @endif
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('name', 'Full Name', ['class' => 'control-label']) !!}
                        {!! Form::text('name', $student->users->name, ['class' => 'form-control', 'placeholder' => '', 'readonly'=>'']) !!}
                        <p class="help-block"></p>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                        {!! Form::text('email', $student->users->email, ['class' => 'form-control', 'placeholder' => '', 'readonly'=>'']) !!}
                        <p class="help-block"></p>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('phone', 'Phone No.', ['class' => 'control-label']) !!}
                        {!! Form::text('phone', $student->users->phone, ['class' => 'form-control', 'placeholder' => '', 'readonly'=>'']) !!}
                        <p class="help-block"></p>
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('course_id', 'Vocational Skill of Interest', ['class' => 'control-label']) !!}

                        <select class="form-control"
                                name="course_id" required>
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option @if($student->course_id==$course->id) selected @endif value="{{ $course->id }}"
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
                                <option @if($student->center_location==$location->id) selected @endif value="{{ $location->id }}"
                                    {{$location->location}}>{{ $location->location }}</option>
                            @endforeach
                        </select>
                        @error('location_id')
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

        @stop
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

