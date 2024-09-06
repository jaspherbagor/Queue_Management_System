@extends('layouts.backend')
@section('title', "Add Image")

@section('content')
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12 text-left ads-list-view">
            <h3>Add Advertisement Image</h3>
            <a href="{{ route('ads_view') }}" class="btn btn-success">All Images</a>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-container" id="printMe">

    <div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data">
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

