@extends('authentication.layout.app')
@section('heading', 'FORGOT PASSWORD')

@section('main_content')
<form action="" method="">
    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email address</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="text-center mb-3">
        <button class="btn me-3 submit-btn fw-semibold mb-md-0 mb-3 py-2 px-3">SUBMIT</button>
        <a href="{{ route('login') }}" class="btn back-to-login-btn fw-semibold mb-md-0 mb-3  py-2 px-3">BACK TO LOGIN</a>
    </div>
</form>
@endsection