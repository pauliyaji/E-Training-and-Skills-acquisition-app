<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Skills Acquisition - Password Reset</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6" style="align-items: center;">
                            <div class="p-5">
                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-1">Reset Your Password</h1>
                                    <p style="font-size: 10px">Password reset link will be sent to your email</p>
                                </div>
                                    <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <!-- Email Address -->
                                        <div class="form-group">
                                           {{-- <x-label for="email" :value="__('Email')" />--}}

                                            <input id="email" class="block mt-1 w-full form-control" type="email"
                                                     placeholder="Enter your Email" name="email" :value="old('email')" required autofocus />
                                        </div>

                                        <div class="flex items-center justify-center mt-4">
                                            <button class="btn btn-success btn-block bg-green-900">
                                                {{ __('Reset Password') }}
                                            </button>
                                        </div>
                                        <p style="font-size: 10px; color: green; text-align: center; padding-top: 5px;"><a href="{{ route('login') }}"> Login Instead </a></p>
                                    </form>

                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <p class="text-danger">{{ $error }}</p>
                                    @endforeach
                                @endif

                                @if(Session::has('message'))
                                    <p class="text-danger">{{session('message')}}</p>
                                @endif
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
