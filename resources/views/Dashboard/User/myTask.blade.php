@extends('layouts.app')

@section('title','My Task Dashboard')

@section('content')
    <div>
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-book"></i></div>
                    <div class="count">{{$MyTasks}}</div>
                    <h3>Tasks</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-check-square"></i></div>
                    <div class="count">{{$done}}</div>
                    <h3>Completed</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-spinner"></i></div>
                    <div class="count">{{$notdone}}</div>
                    <h3>Not Completed</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-percent"></i></div>
                    <div class="count">{{round($percent)}}</div>
                    <h3>Completion</h3>
                </div>
            </div>
        </div>

        <div class="x_title">
            <div class="clearfix"></div>
        </div>

        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Task Summary</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content col-md-6" style="height:40vh">
                    <canvas id="myChart" height="120vh"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-offset-6">
            <div class="x_panel" style="width: 60%">
                <div class="x_title">
                    <h2>Overdue Tasks</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content col-sm-2">
{{--                    <table>--}}
{{--                        <div class="x_title">--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </div>--}}
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                        </tr>--}}
{{--                        <div class="x_title">--}}
{{--                            <div class="clearfix"></div>--}}
{{--                        </div>--}}
{{--                        <tr>--}}
{{--                            <td>Total</td>--}}
{{--                            <td>....</td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
                      <table class="table table-bordered table-condensed">
                                    <tbody>
                                    <tr>
                                        <td width="55%">January</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>February</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>March</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>April</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>May</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>June</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>July</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>August</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>September</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>October</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>November</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>December</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total</strong></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                </div>
            </div>

        </div>


    </div>
@endsection
@section('Scripts')
    <script>

        new Chart(document.getElementById('myChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Task',
                        data: [<?= $janTask ?>,<?= $febTask ?> ,<?= $marTask ?>, <?= $aprTask ?>,
                            <?= $mayTask ?>,<?= $junTask ?>,<?= $julTask ?>,<?= $augTask ?>,
                            <?= $sepTask ?>,<?= $octTask ?>,<?= $novTask ?>,<?= $decTask ?>],
                        backgroundColor: [
                            '#299b74',
                            '#299b74',
                            '#299b74',
                            '#299b74',
                            '#299b74',
                            '#299b74',
                            '#299b74',
                            '#299b74',
                            '#299b74',
                            '#299b74',
                            '#299b74',
                            '#299b74'
                        ]
                    },
                    {
                        label: 'Complete',
                        data: [<?= $janCompleteTask ?>,<?= $febCompleteTask ?> ,<?= $marCompleteTask ?>, <?= $aprCompleteTask ?>,
                            <?= $mayCompleteTask ?>,<?= $junCompleteTask ?>,<?= $julCompleteTask ?>,<?= $augCompleteTask ?>,
                            <?= $sepCompleteTask ?>,<?= $octCompleteTask ?>,<?= $novCompleteTask ?>,<?= $decCompleteTask ?>],
                        backgroundColor: [
                            '#0db7eb',
                            '#0db7eb',
                            '#0db7eb',
                            '#0db7eb',
                            '#0db7eb',
                            '#0db7eb',
                            '#0db7eb',
                            '#0db7eb',
                            '#0db7eb',
                            '#0db7eb',
                            '#0db7eb',
                            '#0db7eb'
                        ]
                    },
                    {
                        label: 'Incomplete',
                        data: [<?= $janInCompleteTask ?>,<?= $febInCompleteTask ?> ,<?= $marInCompleteTask ?>, <?= $aprInCompleteTask ?>,
                            <?= $mayInCompleteTask ?>,<?= $junInCompleteTask ?>,<?= $julInCompleteTask ?>,<?= $augInCompleteTask ?>,
                            <?= $sepInCompleteTask ?>,<?= $octInCompleteTask ?>,<?= $novInCompleteTask ?>,<?= $decInCompleteTask ?>],
                        backgroundColor: [
                            '#21d5eb',
                            '#21d5eb',
                            '#21d5eb',
                            '#21d5eb',
                            '#21d5eb',
                            '#21d5eb',
                            '#21d5eb',
                            '#21d5eb',
                            '#21d5eb',
                            '#21d5eb',
                            '#21d5eb',
                            '#21d5eb'
                        ]
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    labels: {
                        render: 'value'
                    }
                },
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                },
                legend: {
                    position: 'right',
                    labels: {
                        fontStyle: "bold",
                        boxWidth: 30,
                        padding: 20
                    }
                }
            }
        });


    </script>

@endsection
