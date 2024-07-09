@extends('layouts.backend')
@section('title', trans('app.add_department'))

@section('content')
<div class="panel panel-primary" id="printMe">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h3>{{ trans('app.add_department') }}</h3>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="form-container">
            {{ Form::open(['url' => 'admin/department/create', 'class'=>'col-md-7 col-sm-8 add-counter-form']) }}
                <div class="form-group @error('name') has-error @enderror">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter department name:" value="{{ old('name') }}">
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>

                <div class="form-group @error('description') has-error @enderror">
                    <label for="description">Description: </label>
                    <textarea name="description" id="description" placeholder="Enter department description:" class="form-control">{{ old('description') }}</textarea>
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                </div>

                <div class="form-group @error('key') has-error @enderror">
                    <label for="key">Keyboard Mode: </label><br/>
                    {{ Form::select('key', $keyList, null, ['placeholder' => trans('app.select_option'), 'class'=>'select2 form-control', 'style'=>'border: none !important; border-bottom: 2px solid !important;']) }}<br/>
                    <span class="text-danger">{{ $errors->first('key') }}</span>
                </div>

                <div class="form-group @error('status') has-error @enderror">
                    <label for="status">Status: </label>

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
                    <button class="button btn btn-info reset-btn" type="reset"><span>reset</span></button>
                    <button class="button btn btn-success save-btn" type="submit"><span>save</span></button>
                </div>
            {{ Form::close() }}
        </div>

    </div>
</div>
@endsection
