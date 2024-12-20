@extends('layouts.backend')
@section('title', 'Window List')

@section('content')
<div class="panel-heading">
    <ul class="row list-inline m-0">
        <li class="col-xs-10 p-0 text-left">
            <h3>Window List</h3>
        </li>
        <li class="col-xs-2 p-0 text-right">
            <button type="button" class="btn btn-warning info-button btn-sm" data-toggle="modal" data-target="#infoModal">
              <i class="fa fa-info-circle"></i>
            </button>
        </li>
    </ul>
</div>
<div class="panel panel-primary panel-container">

    <div class="panel-body">
        <div class="col-sm-12">
            <table class="datatable table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Window</th>
                        <th>{{ trans('app.description') }}</th>
                        {{-- <th>Date Created</th> --}}
                        {{-- <th>{{ trans('app.updated_at') }}</th> --}}
                        <th>{{ trans('app.status') }}</th>
                        <th><i class="fa fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>

                    @if (!empty($counters))
                        <?php $sl = 1 ?>
                        @foreach ($counters as $counter)
                            <tr>
                                {{-- <td>{{ $sl++ }}</td> --}}
                                <td>{{ $counter->name }}</td>
                                <td>{{ $counter->description }}</td>
                                {{-- <td>{{ (!empty($counter->created_at)?date('j M Y h:i a',strtotime($counter->created_at)):null) }}</td> --}}
                                {{-- <td>{{ (!empty($counter->updated_at)?date('j M Y h:i a',strtotime($counter->updated_at)):null) }}</td> --}}
                                <td>{!! (($counter->status==1)?"<span class='label label-success btn-active'>". trans('app.active') ."</span>":"<span class='label label-danger status-inactive'>". trans('app.deactive') ."</span>") !!}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url("admin/counter/edit/$counter->id") }}" class="btn btn-edit btn-sm" data-toggle="tooltip"  title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="{{ url("admin/counter/delete/$counter->id") }}" class="btn btn-delete btn-sm" data-toggle="tooltip"  title="Delete"><i class="fa fa-trash"></i></a>
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


<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="infoModalLabel"><?= trans('app.note') ?></h4>
      </div>
      <div class="modal-body">
        <p><strong class="label label-warning info-button"> Note 1 </strong> &nbsp;If you delete a Window then, the related tokens are not calling on the Display screen. Because the token is dependent on Window ID</p>
        <p><strong class="label label-warning info-button"> Note 2 </strong> &nbsp;If you want to change a Window name you must rename the Window instead of deleting it.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push("scripts")
@endpush

