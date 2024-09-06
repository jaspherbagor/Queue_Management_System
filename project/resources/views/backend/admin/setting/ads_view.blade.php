@extends('layouts.backend')
@section('title', 'Advertisement View')

@section('content')
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12 text-left">
            <h3>Advertisement Images List</h3>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-container" id="printMe">

    <div class="panel-body">
        <table class="dataTables-server table table-bordered" cellspacing="0">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($images as $row)
                @php 
                $sl = 1;
                @endphp
                <tr>
                   
                    <td>{{ $sl++ }}</td>
                    <td>{{ $row->image }}</td>
                    <td>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

