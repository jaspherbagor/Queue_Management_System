<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \Session::get('app.title') }} :: {{ trans('app.signin') }}</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ \Session::get('app.favicon') }}" type="image/x-icon" />
    <!-- font-awesome -->
    <link href="{{ asset('public/assets/css/font-awesome.min.css') }}" rel='stylesheet'>
    <!-- template bootstrap -->
    <link href="{{ asset('public/assets/css/template.min.css') }}" rel='stylesheet prefetch'>
    <!-- select2 -->
    <link href="{{ asset('public/assets/css/select2.min.css') }}" rel='stylesheet'>
    <!-- Jquery  -->
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <!-- Login CSS -->
    <link rel="stylesheet" href="{{asset('public/assets/css/login_styles.css')}}">
</head>
<body class="cm-login">

   <div class="login-body-container">
    <div class="login-container">
        <div class="login-logo">
            <img src="{{asset('public/assets/images/logo.svg')}}" alt="">
        </div>
        <div class="text-center login-heading">
            <h2 class="text-center text-uppercase">{{ \Session::get('app.title') }}</h2>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <div class="login-body">
                @include('backend.common.info')
                <!-- Starts of Message -->
                <div class="col-xs-12">
                    @yield('info.message')
                </div>
                {{ Form::open(['url' => 'login', 'class'=>'']) }}
                <div class="form-container">
                    <div class="mb-4 form-group">
                       <div class="form-input-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" id="email"  value="{{ old('email') }}" autocomplete="off">
                       </div>
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="mb-4 form-group">
                        <div class="form-input-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" autocomplete="off">
                        </div>
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div>
                        <p class="forgot-password-link"><a href="{{ route('forgot_password') }}">Forgot password?</a></p>
                    </div>
                    <div class="form-button">
                        <button type="submit" class="btn btn-primary login-btn">LOGIN</button>
                    </div>
                </div>
                {{ Form::close() }}
        </div>

    </div>
   </div>



    <!-- <footer class="cm-footer">
        <span class="col-sm-8 col-xs-12 text-left">@yield('info.powered-by') @yield('info.version')</span>
        <span class="col-sm-4 col-xs-12 text-right hidden-xs"> {{ \Session::get('app.copyright_text') }}</span>
    </footer> -->

    <!-- Jquery  -->
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    <!-- bootstrp -->
    <script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
    <!-- select2 -->
    <script src="{{ asset('public/assets/js/select2.min.js') }}"></script>

    <script type="text/javascript">

    $(function() {
        $('table tbody tr').on('click', function() {
            $("input[name=email]").val($(this).children().first().text());
            $("input[name=password]").val($(this).children().first().next().text());
        });

    }(jQuery));

    //preloader
    $(window).load(function() {
        $(".loader").fadeOut("slow");;
    });
    </script>
</body>
</html>
