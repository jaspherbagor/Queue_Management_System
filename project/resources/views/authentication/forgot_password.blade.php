@extends('authentication.layout.app')
@section('heading', 'FORGOT PASSWORD')
{{-- This is a comment --}}
@section('main_content')
<form action="{{ route('forgot_password_submit') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email address</label>
        <input type="email" class="form-control" name="email">
        @if($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="text-center mb-3">
        <button class="btn me-3 submit-btn fw-bold mb-md-0 mb-3 py-2 px-3">SUBMIT</button>
        <a href="{{ route('login') }}" class="btn back-to-login-btn fw-bold mb-md-0 mb-3  py-2 px-3">BACK TO LOGIN</a>
    </div>
</form>
@endsection
