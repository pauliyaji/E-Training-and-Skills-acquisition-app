@extends('layouts/layout')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['submissions.update', $data->id], 'enctype'=>'multipart/form-data']) !!}
    @csrf
    @method('patch')
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

                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('ass_no', 'Assignment no.', ['class' => 'control-label']) !!}
                        {!! Form::text('ass_no', $data->assignments->ass_no, ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
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
                        {!! Form::text('mentor', $data->users->name, ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('description', 'description', ['class' => 'control-label']) !!}
                        {!! Form::textarea('description', $data->description, ['class' => 'form-control', 'placeholder' => '', 'readonly']) !!}
                        <p class="help-block"></p>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    @if(is_null($data->file))
                        <div class="col-md-6 col-xs-12 form-group">
                           <h5>There is no attached file</h5>
                        </div>
                    @else
                    <div class="col-md-6 col-xs-12 form-group">
                        <a href="{{ route('submissions.download', $data->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-download" aria-hidden="true"></i> Download</a>
                    </div>
                        @endif
                </div>
                    @if($data->status == 3)
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}

                            <select class="form-control"
                                    name="status" readonly>
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option @if($data->status==$status->id) selected @endif value="{{ $status->id }}"
                                        {{$status->status}}>{{ $status->status }}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @else    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}

                            <select class="form-control"
                                    name="status" required>
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option @if($data->status==$status->id) selected @endif value="{{ $status->id }}"
                                        {{$status->status}}>{{ $status->status }}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                @endif
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('remarks', 'Remarks', ['class' => 'control-label']) !!}
                            {!! Form::textarea('remarks', $data->remarks, ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @error('remarks')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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

