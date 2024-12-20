@extends('layouts.backend')
@section('title', trans('app.dashboard'))

@section('content')
<div class="panel-heading">
    <h3 class="text-left">DASHBOARD</h3>
</div>
<div class="panel panel-primary dashboard_panel panel-container">

    <div class="panel-body">

        <div class="row">
         <div class="col-md-12">
                <div class="row dashboard-card-container">
                    <div class="col-sm-12 shadowed dashboard-cards">
                        <a href="{{route('department')}}">
                            <div class="col-md-4 col-sm-6 col-xs-12 mb-1">
                                <div class="p-1 department-card">
                                        <img src="{{ asset('public/assets/img/sf/building.svg') }} " alt="" class="icon-img">
                                    <h5><span class="card-qty">{{ (isset($infobox->department)?$infobox->department:0) }} Departments</span> </h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{route('counter')}}">
                            <div class="col-md-4 col-sm-6 col-xs-12 mb-1">
                                <div class="p-1 counter-card">
                                    <img src="{{ asset('public/assets/img/sf/star.svg') }} " alt="" class="icon-img">
                                    <h5><span class="card-qty">{{ (isset($infobox->counter)?$infobox->counter:0) }} Windows</span></h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{route('users')}}">
                            <div class="col-md-4 col-sm-6 col-xs-12 mb-1">
                                <div class="p-1 user-card">
                                    <img src="{{ asset('public/assets/img/sf/profile-group.svg') }} " alt="" class="icon-img">
                                    <h5><span class="card-qty">{{ (isset($infobox->user)?$infobox->user:0) }} Users</span></h5>
                                </div>
                            </div>
                        </a>
                        <a href="{{route('token_report')}}">
                            <div class="col-md-4 col-sm-6 col-xs-12 mb-1">
                                <div class="p-1 total-token-card">
                                    <img src="{{ asset('public/assets/img/sf/user-id.svg') }} " alt="" class="icon-img">
                                    <h5><span class="card-qty">{{ (isset($infobox->token->total)?$infobox->token->total:0) }} Number Created</span></h5>
                                </div>
                            </div>
                        </a>
                        <div class="col-md-4 col-sm-6 col-xs-12 mb-1">
                            <div class="p-1 pending-token-card">
                                <img src="{{ asset('public/assets/img/sf/clock.svg') }} " alt="" class="icon-img">
                                <h5><span class="card-qty">{{ (isset($infobox->token->pending)?$infobox->token->pending:0) }} Pending</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 mb-1">
                            <div class="p-1 complete-token-card">
                                <img src="{{ asset('public/assets/img/sf/sign-check.svg') }} " alt="" class="icon-img">
                                <h5><span class="card-qty">{{ (isset($infobox->token->complete)?$infobox->token->complete:0) }} Completed</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row card-rows mt-1">
            <div class="col-md-6 mb-1">
                <div class="card department-card-info">
                    <h4 class="card-header">DEPARTMENTS</h4>
                    @php
                    $departments = App\Models\Department::all();
                    @endphp

                    <table class="department-table">
                        <tr class="department-tr">
                            <th class="department-th text-uppercase">Name</th>
                            <th class="department-th text-uppercase">Status</th>
                        </tr>

                        @foreach($departments as $row)
                        <tr class="department-tr">
                            <td class="department-td mr-1 text-uppercase">{{$row->name}}</td>
                            @if($row->status === 1)
                            <td class="department-td text-center">
                                <button class="btn btn-active"><i class="fa fa-dot-circle-o" style="color:#03d003"></i> Active</button>
                            </td>
                            @elseif($row->status === 0)
                            <td class="department-td">
                                <button class="btn btn-inactive"><i class="fa fa-dot-circle-o" style="color:#d00303"></i> Inactive</button>
                            </td>
                            @else
                            <td class="department-td">
                                <button class="btn btn-dark">Unknown</button>
                            </td>
                            @endif

                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card counter-card-info p-1">
                    <h4 class="card-header">WINDOWS</h4>
                    @php
                    $counters = App\Models\Counter::all();
                    @endphp
                    <table class="counter-table">
                        <tr class="counter-tr">
                            <th class="counter-th text-uppercase">Window</th>
                            <th class="counter-th text-uppercase">Name</th>
                            <th class="counter-th text-uppercase">Status</th>
                        </tr>

                        @foreach($counters as $row)
                        <tr class="counter-tr">
                            <td class="counter-td mr-1 text-uppercase">{{$row->name}}</td>
                            <td class="counter-td mr-1 text-uppercase fw-bold">{{$row->description}}</td>
                            @if($row->status === 1)
                            <td class="counter-td text-center">
                                <button class="btn btn-active"><i class="fa fa-dot-circle-o" style="color:#03d003"></i> Active</button>
                            </td>
                            @elseif($row->status === 0)
                            <td class="counter-td">
                                <button class="btn btn-inactive"><i class="fa fa-dot-circle-o" style="color:#d00303"></i> Inactive</button>
                            </td>
                            @else
                            <td class="counter-td">
                                <button class="btn btn-dark">Unknown</button>
                            </td>
                            @endif
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-6">
                <div class="panel panel-primary line-chart shadowed">
                    <div class="panel-heading">This Month (All Numbers)</div>
                    <div class="panel-body"><canvas id="lineChart"></canvas></div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-primary bar-chart shadowed">
                    <div class="panel-heading">This Year (All Numbers)</div>
                    <div class="panel-body"><canvas id="singelBarChart" style="height:200px"></canvas></div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-primary shadowed">
                    <div class="performance_heading panel-heading">{{ trans('app.today_user_performance') }}</div>
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

            </div>

            <div class="col-sm-6">

            </div>

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
