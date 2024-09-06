@extends('layouts.backend')
@section('title', 'Advertisement View')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success m-1">{{ Session::get('success') }}</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger m-1">{{ Session::get('error') }}</div>
@endif
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12 ads-list-view">
            <h3>Advertisement Images</h3>
        <a href="{{ route('ads_add') }}" class="btn btn-success save-btn">Add Image</a>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-container" id="printMe">

    <div class="panel-body">
        <table class="dataTables-server table table-bordered" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($images->count() > 0)
                    @php 
                    $sl = 1;
                    @endphp
                    @foreach($images as $row)
                    <tr class="images_data">
                    
                        <td>{{ $sl++ }}</td>
                        <td><img src="{{ asset('public/assets/images/'.$row->image) }}" class="ads_image"></td>
                        <td>
                            <a href="{{ route('ads_delete', $row->id) }}" class="btn btn-danger btn-delete" data-toggle="tooltip"  title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        {{-- <td></td>
                        <td>No data available in the table</td>
                        <td></td> --}}
                        No data available in the table
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

