@extends('layouts/layout')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['mentors.update', $mentor->id], 'enctype'=>'multipart/form-data']) !!}
    @csrf
    @method('patch')
    <div class="container-fluid">

        <!-- Page Heading -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Mentor
                    <a href="{{ route('mentors.index') }}" class="btn btn-success btn-sm float-right">View All</a>
                </h6>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <p class="text-success">{{session('success')}}</p>
                @endif
                    <div class="row">
                        <div class="col-md-6 col-xs-12 form-group">
                            {!! Form::label('position', 'Position', ['class' => 'control-label']) !!}
                            {!! Form::text('position', $mentor->position, ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @error('position')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                        {!! Form::text('address', $mentor->address, ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('area', 'Area of Specialization', ['class' => 'control-label']) !!}
                        {!! Form::text('area', $mentor->area, ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @error('area')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('company', 'Company/Organisation', ['class' => 'control-label']) !!}
                        {!! Form::text('company', $mentor->company, ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @error('company')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12 form-group">
                        {!! Form::label('lga_depts', 'LGA/Department', ['class' => 'control-label']) !!}
                        {!! Form::text('lga_depts', $mentor->lga_depts, ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @error('lga_depts')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-4 form-group">
                        {!! Form::submit('Update', ['class' => 'btn btn-danger btn-sm']) !!}
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

