@extends('authentication.layout.app')
@section('heading', 'RESET PASSWORD')

@section('main_content')
<form action="" method="">
    <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="mb-3">
        <label for="confirm_password" class="form-label fw-semibold">Confirm Password</label>
        <input type="password" class="form-control" name="confirm_password">
    </div>
    <div class="text-center mb-3">
        <button class="btn me-3 reset-password-btn fw-semibold mb-md-0 mb-3 py-2 px-3 w-100">SUBMIT</button>
    </div>
</form>
@endsection