@extends('layouts.backend')
@section('title', trans('app.add_user'))

@section('content')
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12 text-start">
            <h3 class="form-heading">{{ trans('app.add_user') }}</h3>
        </div> 
    </div>
</div>
<div class="panel panel-primary panel-container">

    <div class="panel-body"> 
        <div class="form-container">
            {{ Form::open(['url' => 'admin/user/create', 'files' => true, 'class'=>'col-md-7 col-sm-8']) }}

                <div class="form-group @error('firstname') has-error @enderror">
                    <label for="firstname">{{ trans('app.firstname') }} <i class="text-danger">*</i></label>
                    <input type="text" name="firstname" id="firstname" placeholder="Enter your firstname" class="form-control" value="{{ old('firstname') }}"> 
                    <span class="text-danger">{{ $errors->first('firstname') }}</span>
                </div>

                <div class="form-group @error('lastname') has-error @enderror">
                    <label for="lastname">{{ trans('app.lastname') }}  <i class="text-danger">*</i></label> 
                    <input type="text" name="lastname" id="lastname" placeholder="Enter your lastname" class="form-control" value="{{ old('lastname') }}">
                    <span class="text-danger">{{ $errors->first('lastname') }}</span>
                </div>

                <div class="form-group @error('email') has-error @enderror">
                    <label for="email">{{ trans('app.email') }}  <i class="text-danger">*</i></label> 
                    <input type="text" name="email" id="email" placeholder="Enter your email" class="form-control" value="{{ old('email') }}">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>

                <div class="form-group @error('password') has-error @enderror">
                    <label for="password">{{ trans('app.password') }}  <i class="text-danger">*</i></label> 
                    <input type="password" name="password" id="password" placeholder="Enter your password" class="form-control" value="{{ old('password') }}">
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </div>

                <div class="form-group @error('conf_password') has-error @enderror">
                    <label for="conf_password">{{ trans('app.conf_password') }}  <i class="text-danger">*</i></label> 
                    <input type="password" name="conf_password" placeholder="Enter your confirm password" id="conf_password" class="form-control" value="{{ old('conf_password') }}">
                    <span class="text-danger">{{ $errors->first('conf_password') }}</span>
                </div>

                <div class="form-group @error('user_type') has-error @enderror"> 
                    <label for="user_type">{{ trans('app.user_type') }} <i class="text-danger">*</i></label><br/> 
                    {{ Form::select('user_type', auth()->user()->roles(), old('user_type'), ['placeholder' => trans('app.select_option'), 'class'=>'select2 form-control', 'id'=>'user_type']) }}<br/>
                    <span class="text-danger">{{ $errors->first('user_type') }}</span>
                </div>

                <div class="form-group hide @error('department_id') has-error @enderror" id="user_department">
                    <label for="department_id">{{ trans('app.department') }} <i class="text-danger">*</i></label> 
                    {{ Form::select('department_id', $departmentList, null, ['placeholder' => trans('app.select_option'), 'class'=>'select2 form-control']) }}<br/>
                    <span class="text-danger">{{ $errors->first('department_id') }}</span>
                </div> 

                <div class="form-group @error('mobile') has-error @enderror">
                    <label for="mobile">{{ trans('app.mobile') }} <i class="text-danger">*</i></label> 
                    <input type="text" name="mobile" id="mobile" placeholder="Enter your mobile number" class="form-control" value="{{ old('mobile') }}">
                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <img src="{{ asset((session('photo')?session('photo'):'public/assets/img/icons/no_user.jpg')) }}" alt="Photo" class="img-thubnail thumbnail" width="120" height="80"> 
                        <input type="file" name="photo" id="photo">  
                        <input type="hidden" name="old_photo" value="{{ session('photo') }}">   
                    </div> 

                    <div class="col-sm-4"> 
                        <div class="form-group @error('status') has-error @enderror">
                            <label for="status">{{ trans('app.status') }} <i class="text-danger">*</i></label>
                            <div id="status"> 
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="1" {{ (old("status")==1)?"checked":"" }}> {{ trans('app.active') }}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" {{ (old("status")==0)?"checked":"" }}> {{ trans('app.deactive') }}
                                </label> 
                            </div>
                        </div>  
                    </div> 

                    <div class="col-sm-4">
                        <div class="form-group">
                            <button class="button btn btn-info reset-btn" type="reset"><span>{{ trans('app.reset') }}</span></button>
                            <button class="button btn btn-success save-btn" type="submit"><span>{{ trans('app.save') }}</span></button>
                        </div>
                    </div>
                </div>


            {{ Form::close() }}
        </div>
    </div>
</div> 
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    //user form  
    var user_type       = $("#user_type");
    var user_department = $("#user_department");

    if ("{{ old('user_type') }}" == "1") {
            user_department.removeClass('hide');
    }
    
    user_type.on('change',function() {
        id = $(this).val();

        if (id == 1) {
            user_department.removeClass('hide');
        } else {
            user_department.addClass('hide');
        }
    });
});  
</script>
<script>
    $(document).on('click', '.save-btn', function(e) {
        Swal.fire(
            "Success!",
            "User has been successfully added",
            "success"
        );
    });
</script>  
@endpush
 