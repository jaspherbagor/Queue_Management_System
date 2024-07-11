<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('public/assets/authentication_assets/css/bootstrap.min.css') }}">
    <script src="{{ asset('public/assets/authentication_assets/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/assets/authentication_assets/css/styles.css') }}">
</head>
<body>
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="logo">
                <img src="{{asset('public/assets/images/logo.svg')}}" alt="">
            </div>
            <div class="heading">
                @yield('heading')
            </div>
            @yield('main_content')
        </div>
    </div>
</body>
</html>