@extends('layouts.backend')
@section('title', 'Add Window')

@section('content')
<div class="panel panel-primary panel-container" id="printMe">

    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-12 text-start">
                <h3 class="form-heading">Add Window</h3>
            </div> 
        </div>
    </div>

    <div class="panel-body"> 

        <div class="form-container">
            {{ Form::open(['url' => 'admin/counter/create', 'class'=>'col-md-7 col-sm-8']) }}
     
                <div class="form-group @error('name') has-error @enderror">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter the counter name" value="{{ old('name') }}">
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>

                <div class="form-group @error('description') has-error @enderror">
                    <label for="description">Description: </label> 
                    <textarea name="description" id="description" placeholder="Enter the description" class="form-control">{{ old('description') }}</textarea>
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                </div>

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

                <div class="form-group">
                    <button class="button btn btn-info reset-btn" type="reset"><span>{{ trans('app.reset') }}</span></button>
                    <button class="button btn btn-success save-btn" type="submit"><span>{{ trans('app.save') }}</span></button>
                </div>

            {{ Form::close() }}
        </div>

    </div>
    {{-- This is a comment... --}}
</div> 
@endsection
