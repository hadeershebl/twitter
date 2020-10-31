<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #50abf1;
            height: 100vh;
            }
        #login .container #login-row #login-column #login-box {
            margin-top: 120px;
            max-width: 600px;
            height: 320px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
            
            }
        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
            }
        #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: -100px;
            }
            .logo-img{
                margin-left: 40%;
                margin-bottom: -50px;
                margin-top: 20px
                
            }
        </style>


    </head>
    <body>
            <div id="login">
                <img src="/img/login_logo.png" class="logo-img" height="230px" width="270px" alt="Fashion Logo">
                <div class="container">
                    <div id="login-row" class="row justify-content-center align-items-center">
                        <div id="login-column" class="col-md-6">
                            <div id="login-box" class="col-md-12">
                                {{-- We are checking if we passed a url parameter to the page when we called it.
                                        If we did, we modify the forms action to use the url parameter.
                                        We also modified the header of the form so that it shows
                                        the type of user based on their login parameter. --}}
                            @isset($url)
                                <form id="login-form" method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
                            @else
                                <form id="login-form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @endisset
                                @csrf
                                    <h3 class="text-center text-info" style="color: #50abf1;" >Twitter</h3>
{{----------------------------------- E-mail----------------------------------}}
                                    <div class="form-group">
                                        <label for="email" class="text-info" style="color: #50abf1;">E-Mail Address:</label><br>
                                        <input type="text" name="email" id="username" class="form-control"  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
{{----------------------------------- end----------------------------------}}

{{-----------------------------------Password ----------------------------------}}
                                    <div class="form-group">
                                        <label for="password" class="text-info" style="color: #50abf1;">{{ __('Password') }}:</label><br>
                                        <input type="password" name="password" id="password" class="form-control" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
{{----------------------------------- end----------------------------------}}

{{--------------------------- remember me and Login btn---------------------------}}
                                    <div class="form-group">
                                        <label for="remember-me" class="text-info" style="color: #50abf1;">
                                            <span>Remember me</span> <span>
                                                <input id="remember-me" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                            </span>
                                        </label><br>

                                        <button type="submit" class="btn btn-info btn-md" style="background-color: #50abf1;">
                                            {{ __('Signin') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link text-info" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif

                                    </div>
{{-------------------------------------- end ------------------------------------------}}

                                    <div id="register-link" class="text-right" style="color: #50abf1;">
                                        <a href="{{ route('register') }}" class="text-info">First Time! Register Now</a>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </body>
</html>
