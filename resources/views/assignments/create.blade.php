@extends('layouts/layout')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['assignments.store']]) !!}
    @csrf
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">New Assigment
                   {{-- <a href="{{ URL::previous()}}" class="btn btn-success btn-sm float-right">Back</a>--}}
                    <a href="{{ route('assignments.index')}}" class="btn btn-success btn-sm float-right">View All</a>
                </h6>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <p class="text-success">{{session('success')}}</p>
                @endif
                <div class="row">

                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        <label>Student</label>
                        <select class="form-control" name="student_id" id="select2-dropdown" required>
                            <option value="">Select Student</option>
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
                        {!! Form::label('description', 'description', ['class' => 'control-label']) !!}
                        {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-xs-4 form-group">
                        {!! Form::submit('Send', ['class' => 'btn btn-danger btn-sm']) !!}
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
