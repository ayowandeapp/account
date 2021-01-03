<!DOCTYPE html>
<html lang="en">

<head>
    <title>کیش بک میں داخل ہوں</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('site_assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site_assets/css/bootstrap-responsive.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site_assets/css/maruti-login.css') }}" />
    <style>
        .is-invalid {
            border-color: red;
        }

        .invalid-feedback {
            color: red;
        }

    </style>
</head>

<body>
    <div id="loginbox">
        <form method="POST" action="{{ route('login') }}" id="loginform" class="form-vertical">
            @csrf
            <div class="control-group normal_text">
                {{-- <h3><img src="img/logo.png" alt="Logo" /></h3>
                --}}
                <h3>Login</h3>
            </div>
            @if (Session::has('error'))
                <div class="col-12">
                    <div class="alert alert-warning">{{ Session::get('error') }}</div>
                </div>
            @endif
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on"><i class="icon-user"></i></span>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required placeholder="Email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on"><i class="icon-lock"></i></span>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" placeholder="Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-inverse" id="to-recover">Lost
                        password?</a></span>
                <span class="pull-right"><input type="submit" class="btn btn-success" value="Login" /></span>
            </div>
        </form>
        <form id="recoverform" action="#" class="form-vertical">
            <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a
                password.</p>

            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on"><i class="icon-envelope"></i></span><input type="text"
                        placeholder="E-mail address" />
                </div>
            </div>

            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-inverse" id="to-login">&laquo; Back to
                        login</a></span>
                <span class="pull-right"><input type="submit" class="btn btn-info" value="Recover" /></span>
            </div>
        </form>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/maruti.login.js"></script>
</body>

</html>
