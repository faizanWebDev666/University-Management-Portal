<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <title>Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/css/style.min.css') }}" />
</head>

<body class="font-muli theme-blush">

    <div class="auth option2">
        <div class="auth_left">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <a class="header-brand" href="index.html"><i class="fa fa-graduation-cap brand-logo"></i></a>
                        <div class="card-title mt-3">Login to your account</div>
                        <button type="button" class="btn btn-facebook">
                            <i class="fa fa-facebook mr-2"></i>Facebook
                        </button>
                        <button type="button" class="btn btn-google">
                            <i class="fa fa-google mr-2"></i>Google
                        </button>
                        <h6 class="mt-3 mb-3">Or</h6>
                    </div>

                    <!-- START FORM -->
                    <form method="POST" action="{{ route('Admin.signin.submit') }}">
                        @csrf

                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <a href="forgot-password.html" class="float-right small">I forgot password</a>
                            </label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                        </div>
 @php
                                    use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
                                @endphp

                                <!-- reCAPTCHA -->
                                <div class="mt-4">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    <span style="color: red;">
                                        @error('g-recaptcha-response')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" />
                                <span class="custom-control-label">Remember me</span>
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                            <div class="text-muted mt-4">Don't have an account yet? 
                                <a href="{{ route('Admin.signup') }}">Sign up</a>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM -->

                </div>
            </div>
        </div>
    </div>

    <x-admin-footer/>


