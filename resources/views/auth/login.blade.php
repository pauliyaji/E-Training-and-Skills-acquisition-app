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
                    <img src="{{ asset('/storage/images/'. $data->image) }}" alt="logo" class="logo">
                </div>
                <div class="login-wrapper my-auto" style="padding-bottom: 250px">
                    <h1 class="login-title">Welcome Back!</h1>
                    <p>Sign in to your account with your email and password</p>
                    <form method="POST" action="{{ route('login') }}">                                    @csrf
                    @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com" @if(Cookie::has('adminuser')) value="{{ Cookie::get('adminuser') }}" @endif>
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="enter your passsword" @if(Cookie::has('adminpwd')) value="{{ Cookie::get('adminpwd') }}" @endif>
                        </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input name="rememberme" type="checkbox" class="custom-control-input" id="customCheck"
                               @if(Cookie::has('adminuser')) checked @endif  >
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                    </div>
                </div>
                <input type="submit" value="Login" class="btn btn-success btn-user btn-block" />
                </form>
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    @endif

                    @if(Session::has('message'))
                        <p class="text-danger">{{session('message')}}</p>
                    @endif
                    <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot password?</a>
                    <p class="login-wrapper-footer-text">Don't have an account? <a href="{{ route('register') }}" class="text-reset">Register here</a>
                        or return the our <a href="{{ route('home.index') }}">Website</a></p>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="assets/images/login.jpg" alt="login image" class="login-img">
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</body>
</html>

