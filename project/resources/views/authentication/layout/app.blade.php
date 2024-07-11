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
    <div class="container-fluid d-flex align-items-center justify-content-center content-container">
        <div class="container py-4 px-3 content">
            <div class="logo d-flex align-items-center justify-content-center mb-2">
                <img src="{{asset('public/assets/images/logo.svg')}}" alt="">
            </div>
            <div class="heading text-center mb-4">
                <h2 class="fw-bolder">@yield('heading')</h2>
            </div>
            
            @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            @yield('main_content')
        </div>
    </div>
</body>
</html>