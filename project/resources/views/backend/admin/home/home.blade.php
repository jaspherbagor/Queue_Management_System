@extends('layouts.backend')
@section('title', trans('app.dashboard'))

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading"><h3 class="text-left dashboard-heading">{{ trans('app.dashboard') }}</h3></div>

    <div class="panel-body">

        <div class="row">
            <div class="col-sm-12 shadowed">
                <a href="{{route('department')}}">
                    <div class="btn btn-danger col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-1 department-card">
                        <div class="p-1">
                            <i class="fa fa-cubes fa-2x"></i>
                            <h5>{{ (isset($infobox->department)?$infobox->department:0) }} {{ trans('app.department') }}S</h5>
                        </div>
                    </div>
                </a>
                <a href="{{route('counter')}}">
                    <div class="btn btn-warning col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-1 counter-card">
                        <div class="p-1">
                            <i class="fa fa-plus-square-o fa-2x"></i>
                            <h5>{{ (isset($infobox->counter)?$infobox->counter:0) }} {{ trans('app.counter') }}S</h5>
                        </div>
                    </div>
                </a>
            <a href="{{route('users')}}">
                <div class="btn btn-primary col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-1 user-card">
                        <div class="p-1">
                            <i class="fa fa-users fa-2x"></i>
                            <h5>{{ (isset($infobox->user)?$infobox->user:0) }} {{ trans('app.users') }}</h5>
                        </div>
                    </div>
            </a>
                <a href="{{route('token_report')}}">
                    <div class="btn btn-success col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-1 total-token-card">
                        <div class="p-1">
                            <i class="fa fa-ticket fa-2x"></i>
                            <h5>{{ (isset($infobox->token->total)?$infobox->token->total:0) }} {{ trans('app.token') }}</h5>
                        </div>
                    </div>
                </a>
                <div class="btn btn-warning col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-1 pending-token-card">
                    <div class="p-1">
                        <i class="fa fa-clock-o fa-2x"></i>
                        <h5>{{ (isset($infobox->token->pending)?$infobox->token->pending:0) }} {{ trans('app.pending') }} {{ trans('app.token') }}</h5>
                    </div>
                </div>
                <div class="btn btn-success col-lg-2 col-md-4 col-sm-6 col-xs-12 mb-1 complete-token-card">
                    <div class="p-1">
                        <i class="fa  fa-check-circle-o fa-2x"></i>
                        <h5>{{ (isset($infobox->token->complete)?$infobox->token->complete:0) }} {{ trans('app.complete') }} {{ trans('app.token') }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row card-rows mt-1">
            <div class="col-md-6">
                <div class="card department-card p-1">
                    <h2 class="card-header text-center">Department</h2>
                    @php
                    $departments = App\Models\Department::all();
                    @endphp

                    @foreach($departments as $row)
                    <h4 class="department-list">* {{$row->name}}</h4>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="card counter-card p-1">
                    <h2 class="card-header text-center">Counter</h2>
                    @php
                    $counters = App\Models\Counter::all();
                    @endphp
                    <!-- <table class="counter-table">
                        <tr class="counter-tr">
                            <th class="counter-th mr-1"></th>
                            <th class="counter-th mr-1"></th>
                            <th class="counter-th"></th>
                        </tr>

                        @foreach($counters as $row)
                        <tr class="counter-tr">
                            <td class="counter-td mr-1">{{$row->name}}</td>
                            <td class="counter-td mr-1>{{$row->description}}</td>
                            @if($row->status === 1)
                            <td class="counter-td">
                                <button class="btn btn-success">Active</button>
                            </td>
                            @elseif($row->status === 2)
                            <td class="counter-td">
                                <button class="btn btn-danger">Inactive</button>
                            </td>
                            @else
                            <td class="counter-td">
                                <button class="btn btn-dark">Unknown</button>
                            </td>
                            @endif
                        </tr>
                        @endforeach

                    </table> -->

                    @foreach($counters as $row)
                        <div class="counters-div">
                            <h4>{{$row->name}}  &nbsp- &nbsp {{$row->description}}  &nbsp- &nbsp @if($row->status === 1)Active @else Inactive @endif</h4>
                             <!-- <li>{{$row->name}}</li>
                             <li>{{$row->description}}</li>
                             <li>{{$row->status}}</li> -->
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-primary shadowed">
                    <div class="panel-heading">{{ trans('app.this_month') }}</div>
                    <div class="panel-body"><canvas id="lineChart"></canvas></div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-primary shadowed">
                    <div class="panel-heading">{{ trans('app.this_year') }}</div>
                    <div class="panel-body"><canvas id="singelBarChart" style="height:200px"></canvas></div>
                </div>
            </div>

            <!-- <div class="col-sm-6">
                <div class="panel panel-primary shadowed">
                    <div class="panel-heading">{{ trans('app.today_user_performance') }}</div>
                    <div class="panel-body">
                    @if (!empty($performance))
                    @foreach($performance as $user)
                    @php
                    $pending = number_format(((($user->pending?$user->pending:0)/($user->total?$user->total:1))*100),1);
                    $complete = number_format(((($user->complete?$user->complete:0)/($user->total?$user->total:1))*100),1);
                    $stop = number_format(((($user->stop?$user->stop:0)/($user->total?$user->total:1))*100),1);
                    @endphp
                        <div class="row">
                            <label class="col-sm-3 col-xs-12">{{ $user->username }}</label>
                            <div class="col-sm-9 col-xs-12">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-danger" style="width: {{ $stop }}%">
                                    <span>{{ $stop }}% {{trans("app.stop")}} (Total {{ $user->stop }}) </span>
                                  </div>
                                  <div class="progress-bar progress-bar-success" style="width: {{ $complete }}%">
                                    <span>{{ $complete }}% {{trans("app.complete")}} (Total {{ $user->complete }}) </span>
                                  </div>
                                  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{{ $pending }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $pending }}%">
                                    <span>{{ $pending }}% {{trans("app.pending")}} (Total {{ $user->pending }}) </span>
                                  </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-sm-6">
                <div class="panel panel-primary shadowed mb-3">
                    <div class="panel-heading">{{ trans('app.from_the_begining') }}</div>
                    <div class="panel-body"><canvas id="pieChart" style="height:200px"></canvas></div>
                </div>
            </div> -->
        </div>
    </div>

</div>
@endsection

@push("scripts")
<script src="{{ asset('public/assets/js/Chart.min.js') }}"></script>
<script type="text/javascript">
$(window).on('load', function(){

    //line chart
    var ctx = document.getElementById("lineChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                <?php
                if (!empty($month)) {
                    for ($i=0; $i < sizeof($month) ; $i++) {
                       echo (!empty($month[$i])?$month[$i]->date:0).", ";
                    }
                }
                ?>
            ],
            datasets: [
                {
                    label: "Total",
                    borderColor: "rgba(24, 97, 142, .9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(24, 97, 142, .09)",
                    pointHighlightStroke: "rgba(24, 97, 142, 1)",
                    data: [
                        <?php
                        if (!empty($month)) {
                            for ($i=0; $i < sizeof($month) ; $i++) {
                               echo (!empty($month[$i])?$month[$i]->total:0).", ";
                            }
                        }
                        ?>
                    ]
                },
                {
                    label: "Success",
                    borderColor: "rgba(225, 48, 91, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(225, 48, 91, 0.09)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [
                        <?php
                        if (!empty($month)) {
                            for ($i=0; $i < sizeof($month) ; $i++) {
                               echo (!empty($month[$i])?$month[$i]->success:0).", ";
                            }
                        }
                        ?>
                    ]
                },
                {
                    label: "Pending",
                    borderColor: "rgba(0,0,0, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0, 0.09)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [
                        <?php
                        if (!empty($month)) {
                            for ($i=0; $i < sizeof($month) ; $i++) {
                               echo (!empty($month[$i])?$month[$i]->pending:0).", ";
                            }
                        }
                        ?>
                    ]
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }
        }
    });


    // single bar chart
    var ctx = document.getElementById("singelBarChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                if (!empty($year)) {
                    for ($i=0; $i < sizeof($year) ; $i++) {
                       echo "'".(!empty($year[$i])?$year[$i]->month:0)."', ";
                    }
                }
                ?>
            ],
            datasets: [
                {
                    label: "Total",
                    borderColor: "rgba(24, 97, 142, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(24, 97, 142, 0.5)",
                    data: [
                        <?php
                        if (!empty($year)) {
                            for ($i=0; $i < sizeof($year) ; $i++) {
                               echo (!empty($year[$i])?$year[$i]->total:0).", ";
                            }
                        }
                        ?>
                    ]
                },
                {
                    label: "Success",
                    borderColor: "rgba(225, 48, 91, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(225, 48, 91, 0.5)",
                    data: [
                        <?php
                        if (!empty($year)) {
                            for ($i=0; $i < sizeof($year) ; $i++) {
                               echo (!empty($year[$i])?$year[$i]->success:0).", ";
                            }
                        }
                        ?>
                    ]
                },
                {
                    label: "Pending",
                    borderColor: "rgba(0,0,0, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0, 0.5)",
                    data: [
                        <?php
                        if (!empty($year)) {
                            for ($i=0; $i < sizeof($year) ; $i++) {
                               echo (!empty($year[$i])?$year[$i]->pending:0).", ";
                            }
                        }
                        ?>
                    ]
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    });



    // pie chart
    var ctx = document.getElementById("pieChart");
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: [{
                    data: [
                        <?php
                        if (!empty($begin) && is_array($begin)) {
                               echo (!empty($begin[0])?$begin[0]->total:0).", ";
                               echo (!empty($begin[0])?$begin[0]->success:0).", ";
                               echo (!empty($begin[0])?$begin[0]->pending:0);
                        }
                        ?>
                    ],
                    backgroundColor: [
                        "rgba(24, 97, 142,0.9)",
                        "rgba(225, 48, 91,0.7)",
                        "rgba(0,0,0,0.5)",
                        "rgba(0,0,0,0.07)"
                    ],
                    hoverBackgroundColor: [
                        "rgba(24, 97, 142,0.9)",
                        "rgba(225, 48, 91,0.7)",
                        "rgba(0,0,0,0.5)",
                        "rgba(0,0,0,0.07)"
                    ]

                }],
            labels: [
                "Total",
                "Success",
                "Pending"
            ]
        },
        options: {
            responsive: true
        }
    });

});
</script>
@endpush
