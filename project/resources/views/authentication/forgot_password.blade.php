@extends('authentication.layout.app')
@section('heading', 'Forgot Password')

@section('main_content')
<form action="" method="">
    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email address</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="text-center">
        <button class="btn btn-success me-3 submit-btn fw-semibold">Submit</button>
        <button class="btn btn-warning back-to-login-btn fw-semibold">Back to Login</button>
    </div>
</form>
@endsection