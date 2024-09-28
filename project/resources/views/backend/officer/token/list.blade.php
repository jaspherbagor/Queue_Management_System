@extends('layouts.backend')
@section('title', 'Queue List')

@section('content')
<div class="panel-heading">
    <div class="row">
        <div class="col-sm-12 text-left">
            <h3>QUEUE LIST</h3>
        </div>
    </div>
</div>
<div class="panel panel-primary panel-container">

    <div class="panel-body">
        <table class="dataTables-server display table table-bordered" width="100%" cellspacing="0">
            <thead>

                {{-- <tr>
                    <th></th>
                    <th>
                        {{ Form::select('department', $departments, null, ['id'=>'department', 'class'=>'select2 filter', 'placeholder'=> trans('app.department')]) }}
                    </th>
                    <th>
                        {{ Form::select('counter', $counters, null, ['id'=>'counter', 'class'=>'select2 filter', 'placeholder'=> trans('app.counter')]) }}
                    </th>
                    <th>
                        {{ Form::select('status', ["'0'"=>trans("app.pending"), '1'=>trans("app.complete"), '2'=>trans("app.stop")],  null,  ['placeholder' => trans("app.status"), 'id'=> 'status', 'class'=>'select2 filter']) }}
                    </th>
                    <th></th>
                    <th></th>
                </tr> --}}
                <tr>
                    <th>Queue</th>
                    <th>Service</th>
                    <th>Window</th>
                    <th>{{ trans('app.status') }}</th>
                    <th>{{ trans('app.complete_time') }}</th>
                    <th>{{ trans('app.action') }}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function(){
    // DATATABLE
    drawDataTable();

    $("body").on("change",".filter", function(){
        drawDataTable();
    });

    function drawDataTable()
    {
        $('.dataTables-server').DataTable().destroy();
        $('.dataTables-server').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url:'<?= url('officer/token/data'); ?>',
                dataType: 'json',
                type    : 'post',
                data    : {
                    _token : '{{ csrf_token() }}',
                    search: {
                        status     : $('#status').val(),
                        counter    : $('#counter').val(),
                        department : $('#department').val(),
                        start_date : $('#start_date').val(),
                        end_date   : $('#end_date').val(),
                    }
                }
            },
            columns: [
                { data: 'token_no' },
                { data: 'department' },
                { data: 'counter' },
                { data: 'status' },
                { data: 'complete_time' },
                { data: 'options' }
            ],
            order: [ [0, 'desc'] ],
            select    : true,
            pagingType: "full_numbers",
            lengthMenu: [[25, 50, 100, 150, 200, 500, -1], [25, 50, 100, 150, 200, 500, "All"]],
        });
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
                    content += "<li><strong>Service:</strong> "+data.department+"</li>";
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
