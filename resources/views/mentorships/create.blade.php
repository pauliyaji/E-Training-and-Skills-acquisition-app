@extends('layouts/layout')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['mentorships.store']]) !!}
    @csrf
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Assign for Mentorship
                    <a href="{{ route('mentorships.index') }}" class="btn btn-success btn-sm float-right">View All</a>
                </h6>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <p class="text-success">{{session('success')}}</p>
                @endif
                <div class="row">
                    <input type="hidden" value="{{ $data->user_id }}" name="user_id">

                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('user', 'Full Name', ['class' => 'control-label']) !!}
                        {!! Form::text('user', $data->users->name, ['class' => 'form-control', 'placeholder' => '', 'readonly' => '']) !!}
                        <p class="help-block"></p>
                        @error('user_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        <label>Mentor</label>
                        <select class="form-control" name="mentor_id" id="select2-dropdown" required>
                            <option value="">Select Mentor</option>
                            @foreach($mentors as $mentor)
                                <option value="{{ $mentor->id }}"
                                    {{$mentor->id}}>{{ $mentor->users->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('duration', 'Duration in Months', ['class' => 'control-label']) !!}
                        {!! Form::number('duration', old('duration'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @error('duration')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('start_date', 'Start Date', ['class' => 'control-label']) !!}
                        {!! Form::date('start_date', old('start_date'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @error('start_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('end_date', 'End Date', ['class' => 'control-label']) !!}
                        {!! Form::date('end_date', old('end_date'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @error('end_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('total_assignment_expected', 'Total Assignments Expected', ['class' => 'control-label']) !!}
                            {!! Form::number('total_assignment_expected', old('total_assignment_expected'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @error('total_assignment_expected')
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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
