@extends('layouts.backend')
@section('title', 'Window List')

@section('content')
<div class="panel-heading">
    <ul class="row list-inline m-0">
        <li class="col-xs-10 p-0 text-left">
            <h3>Number Report for {{ $service_info->name }}</h3>
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
                        <th>Queue Number</th>
                        <th>Service</th>
                        <th>Window</th>
                        <th>Officer</th>
                        <th>Generated Time</th>
                        <th>Complete Time</th>
                        <th>Status</th>
                        <th>Action</th>
                        {{-- <th><i class="fa fa-cogs"></i></th> --}}
                    </tr>
                </thead>
                <tbody>

                    @if (!empty($queue_numbers))
                        <?php $sl = 1 ?>
                        @foreach ($queue_numbers as $row)

                            @php
                            $window_info = \App\Models\Counter::where('id', $row->counter_id)->first();
                            $officer_info = \App\Models\User::where('id', $row->user_id)->first();

                            $complete_time = "";
                            if (!empty($row->updated_at)) {
                                $date1 = new \DateTime($row->created_at);
                                $date2 = new \DateTime($row->updated_at);
                                $diff  = $date2->diff($date1);
                                $complete_time = (($diff->d > 0) ? " $diff->d Days " : null) . "$diff->h Hours $diff->i Minutes ";
                            }
                            @endphp
                            <tr>
                                <td>{{ $row->token_no }}</td>
                                <td>{{ $service_info->name }}</td>
                                <td>{{ $window_info->name }}</td>
                                <td>{{ $officer_info->firstname }} {{ $officer_info->lastname }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('F j, Y g:i A') }}                                </td>
                                <td>{{ $complete_time }}</td>
                                <td>
                                    @if($row->status === 0)
                                    <span class="label label-danger status-inactive">Pending</span>
                                    @elseif($row->status === 1)
                                    <span class="label label-success btn-active">Completed</span>
                                    @else
                                    <span class="label label-warning">Stop</span>
                                    @endif
                                </td>
                                <td>
                                        @if($row->status === 0)
                                        <a href="{{ url("admin/token/complete/$row->id") }}"  class="btn btn-success btn-sm btn-complete mb-1" title="Complete"><i class="fa fa-check"></i></a>

                                        <a href="{{ url("admin/token/stoped/$row->id") }}"  class="btn btn-warning btn-sm btn-stop mb-1" title="Stop"><i class="fa fa-stop"></i></a>

                                        <button type="button" data-toggle="modal" data-target="transferModal" data-token-id="{{ $row->id }}" class="btn btn-primary btn-sm btn-transfer mb-1" title="Transfer"><i class="fa fa-exchange"></i></button>

                                        @endif
                                        <a type="button" href="{{ url("admin/token/print") }}" data-token-id="{{ $row->id }}" class="tokenPrint btn btn-default btn-sm btn-print mb-1" title="Print" ><i class="fa fa-print"></i></a>
                                        <a href='{{ url("admin/token/delete/$row->id") }}'class="btn btn-danger btn-sm btn-delete mb-1" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Transfer Modal -->
<div class="modal fade transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel">
  <div class="modal-dialog" role="document">
    {{ Form::open(['url' => 'admin/token/transfer', 'class'=>'transferFrm']) }}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="transferModalLabel">{{ trans('app.transfer_a_token_to_another_counter') }}</h4>
      </div>
      <div class="modal-body">
        <div class="alert hide"></div>
        <input type="hidden" name="id">
        <p>
            <label for="department_id" class="control-label">{{ trans('app.department') }} </label>
            {{ Form::select('department_id', $departments, null, ['placeholder' => 'Select Option', 'class'=>'select2', 'id'=>'department_id']) }}
        </p>

        <p>
            <label for="counter_id" class="control-label">{{ trans('app.counter') }} </label>
            {{ Form::select('counter_id', $counters, null, ['placeholder' => 'Select Option', 'class'=>'select2', 'id'=>'counter_id']) }}
        </p>

        <p>
            <label for="user_id" class="control-label">{{ trans('app.officer') }} </label>
            {{ Form::select('user_id', $officers, null, ['placeholder' => 'Select Option', 'class'=>'select2', 'id'=>'user_id']) }}
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="button btn btn-success" type="submit"><span>{{ trans('app.transfer') }}</span></button>
      </div>
    </div>
    {{ Form::close() }}
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
<script>
$('.btn-delete').on('click', function(event) {
    event.preventDefault();
    let counterId = $(this).data('counter-id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this window!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ffc107',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `{{ url('admin/counter/delete') }}/${counterId}`;
        }
    });
});

function () {
  // modal open with token id
$('.modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $('input[name=id]').val(button.data('token-id'));
    });

// transfer token
$('body').on('submit', '.transferFrm', function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        contentType: false,
        // cache: false,
        processData: false,
        data:  new FormData($(this)[0]),
        beforeSend: function() {
            $('.transferFrm').find('.alert')
                .addClass('hide')
                .html('');
        },
        success: function(data)
        {
            if (data.status)
            {
                $('.transferFrm').find('.alert')
                    .addClass('alert-success')
                    .removeClass('hide alert-danger')
                    .html(data.message);

                setTimeout(() => { window.location.reload() }, 1500);
            }
            else
            {
                $('.transferFrm').find('.alert')
                    .addClass('alert-danger')
                    .removeClass('hide alert-success')
                    .html(data.exception);
            }
        },
        error: function(xhr)
        {
            alert('wait...');
        }
    });

});
}
</script>

@endpush

