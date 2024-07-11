@extends('authentication.layout.app')
@section('heading', 'RESET PASSWORD')

@section('main_content')
<form action="{{ route('reset_password_submit') }}" method="post">
    @csrf
    <input type="hidden" value="{{ $email }}" name="email">
    <input type="hidden" value="{{ $token }}" name="token">
    <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" class="form-control" name="password">
        @if($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div class="mb-3">
        <label for="confirm_password" class="form-label fw-semibold">Confirm Password</label>
        <input type="password" class="form-control" name="confirm_password">
        @if($errors->has('confirm_password'))
        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
        @endif
    </div>
    <div class="text-center mb-3">
        <button class="btn me-3 reset-password-btn fw-semibold mb-md-0 mb-3 py-2 px-3 w-100">UPDATE</button>
    </div>
</form>
@endsection