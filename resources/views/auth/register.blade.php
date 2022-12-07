<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Template</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 login-section-wrapper">
                <div class="brand-wrapper">
                    <img src="{{ asset('/storage/images/'. $setting->image) }}" alt="logo" class="logo">
                </div>
                <div class="login-wrapper my-auto">
                    <h1 class="login-title">Create an Account!</h1>
                    <p>Enter your personal information to register on {{ $setting->institution }}</p>
                    {!! Form::open(['method' => 'POST', 'route' => ['register'], 'enctype'=>'multipart/form-data']) !!}
                      @csrf
                        <div class="form-group">
                            {!! Form::label('name', 'Full Name', ['class' => 'control-label']) !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
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
                        <div class="form-group">
                            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                            {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', 'Phone No.', ['class' => 'control-label']) !!}
                            {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            <p class="help-block"></p>
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                            <input type="password" class="form-control" name="password" id="password" value=""  required/>
                            <p class="help-block"></p>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            {!! Form::label('password', 'Confirm Password', ['class' => 'control-label']) !!}
                            <input class="form-control" id="password" type="password" name="password_confirmation" required>
                            <p class="help-block"></p>
                        </div>
                        <div class="form-group mb-4">
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
                        <div class="form-group mb-4">
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
                        <div class="form-group mb-4">
                            <label>Passport Photo</label>
                            <input type="file" name="photo" id="photo" value="" class="form-control" />
                            @error('photo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="submit" value="Register" class="btn btn-success btn-user btn-block" />
                    {!! Form::close() !!}

                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    @endif

                    @if(Session::has('message'))
                        <p class="text-danger">{{session('message')}}</p>
                    @endif
                    <br>
                    <p class="login-wrapper-footer-text">Already a user, return to <a href="{{ route('login') }}" class="text-reset">Login</a></p>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="assets/images/login.jpg" height="100%" alt="login image" class="login-img">
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
