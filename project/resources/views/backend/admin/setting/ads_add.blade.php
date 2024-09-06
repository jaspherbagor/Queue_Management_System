@extends('layouts.backend')
@section('title', "Add Image")

@section('content')
@if(Session::has('success'))
<div class="alert alert-success m-1">{{ Session::get('success') }}</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger m-1">{{ Session::get('error') }}</div>
@endif
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12 text-left ads-list-view">
            <h3>Add Advertisement Image</h3>
            <a href="{{ route('ads_view') }}" class="btn btn-success save-btn">All Images</a>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-container" id="printMe">

    <div class="panel-body">
        <form action="{{ route('ads_submit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group @error('image') has-error @enderror">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
                <span class="text-danger">{{ $errors->first('image') }}</span>
            </div>


            <div class="form-group">
                <button class="button btn btn-success save-btn" type="submit"><span>Add</span></button>
            </div>
        </form>
    </div>
</div>
@endsection

