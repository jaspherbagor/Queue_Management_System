@extends('layouts.backend')
@section('title', trans('app.todays_token'))

@section('content')
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12 text-left">
            <h3>{{ trans('app.active') }} / Current Queues</h3>
        </div> 
    </div>
</div>
<div class="panel panel-primary panel-container">

    <div class="panel-body">
        <table class="datatable display table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    {{-- <th>#</th> --}}
                    <th>Queue</th>
                    <th>Service</th>
                    <th>Window</th>
                    {{-- <th>{{ trans('app.client_mobile') }}</th> --}}
                    {{-- <th>{{ trans('app.note') }}</th> --}}
                    <th>{{ trans('app.status') }}</th>
                    {{-- <th>{{ trans('app.created_by') }}</th>
                    <th>{{ trans('app.created_at') }}</th> --}}
                    <th width="120">{{ trans('app.action') }}</th>
                </tr>
            </thead> 
            <tbody>
                @if (!empty($tokens))
                    <?php $sl = 1 ?>
                    @foreach ($tokens as $token)
                        <tr>
                            {{-- <td>{{ $sl++ }}</td> --}}
                            <td>
                                {!! (!empty($token->is_vip)?("<span class=\"label label-danger\" title=\"VIP\">$token->token_no</span>"):$token->token_no) !!} 
                            </td>
                            <td>{{ !empty($token->department)?$token->department->name:null }}</td>
                            <td>{{ !empty($token->counter)?$token->counter->name:null }}</td> 
                            <td> 
                                @if($token->status==0) 
                                <span class="label label-primary status-pending">{{ trans('app.pending') }}</span> 
                                @elseif($token->status==1)   
                                <span class="label label-success">{{ trans('app.complete') }}</span>
                                @elseif($token->status==2) 
                                <span class="label label-danger">{{ trans('app.stop') }}</span>
                                @endif
                                {!! (!empty($token->is_vip)?('<span class="label label-danger" title="VIP">VIP</span>'):'') !!}
                            </td>
                            {{-- <td>{!! (!empty($token->generated_by)?("<a href='".url("officer/user/view/{$token->generated_by->id}")."'>".$token->generated_by->firstname." ". $token->generated_by->lastname."</a>"):null) !!}</td> 
                            <td>{{ (!empty($token->created_at)?date('j M Y h:i a',strtotime($token->created_at)):null) }}</td> --}}
                            <td>
                                {{-- <div class="btn-group">  --}}
                                    <a href="{{ url('officer/token/complete/'.$token->id) }}" 
                                        class="btn btn-success btn-sm btn-complete mb-1" 
                                        data-token-id="{{ $token->id }}" 
                                        title="Complete">
                                         <i class="fa fa-check"></i>
                                     </a> 
                                 
                                     <a href="{{ url('officer/token/stoped/'.$token->id) }}" 
                                        class="btn btn-warning btn-sm btn-stop mb-1" 
                                        data-token-id="{{ $token->id }}" 
                                        title="Stop">
                                         <i class="fa fa-stop"></i>
                                     </a>
                                 
                                     {{-- <button type="button" 
                                             href='{{ url('officer/token/print') }}' 
                                             data-token-id='{{ $token->id }}' 
                                             class="tokenPrint btn btn-default btn-sm btn-print" 
                                             title="Print">
                                         <i class="fa fa-print"></i>
                                     </button> --}}
                                {{-- </div> --}}
                            </td>
                        </tr> 
                    @endforeach
                @endif
            </tbody>
        </table>
    </div> 
</div>   
@endsection

@push("scripts")
<script type="text/javascript">
(function() {
    if (window.addEventListener) {
        window.addEventListener("load", loadHandler, false);
    }
    else if (window.attachEvent) {
        window.attachEvent("onload", loadHandler);
    }
    else {
        window.onload = loadHandler;
    }

    function loadHandler() {
        setTimeout(doMyStuff, 60000);
    }

    function doMyStuff() { 
        window.location.reload();
    }
  
    // modal open with token id
    $('.modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $('input[name=id]').val(button.data('token-id'));
    }); 

    // print token
    $("body").on("click", ".tokenPrint", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            type:'POST',
            dataType: 'json',
            data: {
                'id' : $(this).attr('data-token-id'),
                '_token':'<?php echo csrf_token() ?>'
            },
            success:function(data)
            {  
                // Function to format the date
                function formatDate(dateString) {
                        var date = new Date(dateString);
                        var month = ('0' + (date.getMonth() + 1)).slice(-2); // Adding 1 because getMonth() returns 0-11
                        var day = ('0' + date.getDate()).slice(-2);
                        var year = date.getFullYear();

                        return month + '/' + day + '/' + year;
                    }

                    // Example usage
                    var formattedDate = formatDate(data.created_at);

                    var content = "<style type=\"text/css\">@media print {"+
                    "html, body {margin:0; padding:0; overflow:hidden; display:block; width:100%; font-family:Arial, sans-serif;}"+
                    ".receipt-token {width:100%; text-align:center; margin-top:30px; margin-bottom:30px; border: 1px dotted black}"+
                    ".receipt-token h4 {margin:5px 0; padding:0; font-size:20px; line-height:24px;}"+
                    ".receipt-token h1 {margin:5px 0; padding:0; font-size:40px; line-height:30px;}"+
                    ".receipt-token ul {margin:0; padding:0; font-size:12px; line-height:8px; list-style:none; text-align:center; align-items:center; justify-content:center;}"+
                    ".receipt-token ul li.date {margin-bottom:20px !important;}" +
                    ".receipt-token ul li {margin:5px 0;}"+
                    "}</style>";

                    content += "<div class=\"receipt-token\">";
                    // content += "<h4>{{ \Session::get('app.title') }}</h4>";
                    content += "<h1>"+data.token_no+"</h1>";
                    content +="<ul>";
                    content += "<li><strong>Window:</strong> "+data.counter+"</li>";
                    content += "<li><strong>Dept:</strong> "+data.department+"</li>";
                    content += "<li class=\"date\"><strong>{{ trans('app.date') }}:</strong> "+formattedDate+"</li>";
                    content += "</ul>";
                    content += "</div>";
                
                // print 
                printThis(content);


            }, error:function(err){
                alert('failed!');
            }
        });  
    });
    
})();
</script>
@endpush
 