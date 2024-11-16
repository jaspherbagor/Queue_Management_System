@extends('layouts.backend')
@section('title', 'Queue Report')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12 text-left">
            <h3>Number Report</h3>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-container">

    <div class="panel-body">
        <div class="col-sm-12">
            <table class="datatable table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Department</th>
                        <th>{{ trans('app.description') }}</th>
                        <th>Hot Key</th>
                        <th>{{ trans('app.status') }}</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if (!empty($departments))
                        <?php $sl = 1 ?>
                        @foreach ($departments as $department)
                            <tr>
                                {{-- <td>{{ $sl++ }}</td> --}}
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->description }}</td>
                                <td>{{ $department->key }}</td>
                                {{-- <td>{{ (!empty($department->created_at)?date('j M Y h:i a',strtotime($department->created_at)):null) }}</td> --}}
                                {{-- <td>{{ (!empty($department->updated_at)?date('j M Y h:i a',strtotime($department->updated_at)):null) }}</td> --}}
                                <td>{!! (($department->status==1)?"<span class='label label-success btn-active status-active'>". trans('app.active') ."</span>":"<span class='label label-danger status-inactive'>". trans('app.deactive') ."</span>") !!}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('report_detail', $department->id) }}" class="btn btn-info report-btn mb-1">View Report</a>
                                        <a href="{{route('delete_all_numbers', $department->id)}}" class="btn btn-danger delete-all-btn btn-delete"  data-toggle="tooltip"  title="Delete All Numbers"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
