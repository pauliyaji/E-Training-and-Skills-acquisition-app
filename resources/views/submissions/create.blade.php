@extends('layouts/layout')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['submissions.store'], 'enctype'=>'multipart/form-data']) !!}
    @csrf
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">New Assigment
                     <a href="{{ URL::previous()}}" class="btn btn-success btn-sm float-right">Back</a>

                </h6>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <p class="text-success">{{session('success')}}</p>
                @endif
                <input type="hidden" value="{{ $data->id }}" name="ass_id">
                    <input type="hidden" value="{{ $data->mentor_id }}" name="mentor_id">

                    <input type="hidden" value="{{ $data->id }}" name="ass_id">

                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('ass_no', 'Assignment no.', ['class' => 'control-label']) !!}
                            {!! Form::text('ass_no', $data->ass_no, ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('student_no', 'Student no.', ['class' => 'control-label']) !!}
                            {!! Form::text('student_no', $data->student_no, ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('mentor', 'Mentor', ['class' => 'control-label']) !!}
                            {!! Form::text('mentor', $data->mentors->name, ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('description', 'description', ['class' => 'control-label']) !!}
                            {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            <label for="name" class="col-sm-6 control-label">If you have a file to Upload</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="file" name="file" value="">
                                <span class="text-danger" id="fileError"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-xs-4 form-group">
                            {!! Form::submit('Submit', ['class' => 'btn btn-danger btn-lg']) !!}
                        </div>
                    </div>
                </div>
            </div>

        {!! Form::close() !!}
        @include('layouts/footer')
        <!-- Bootstrap core JavaScript-->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



@stop

