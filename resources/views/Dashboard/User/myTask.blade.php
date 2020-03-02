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


        <div class="col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Task Summary</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content col-md-12" style="height: 40vh">
                    <canvas id="myChart" height="120vh"></canvas>
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
                labels: ['Jan', 'Feb', 'Mar', 'Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [
                    {
                        label: 'Complete',
                        data: [<?= $janCompleteTask ?>,<?= $febCompleteTask ?> ,<?= $marCompleteTask ?>, <?= $aprCompleteTask ?>,
                            <?= $mayCompleteTask ?>,<?= $junCompleteTask ?>,<?= $julCompleteTask ?>,<?= $augCompleteTask ?>,
                            <?= $sepCompleteTask ?>,<?= $octCompleteTask ?>,<?= $novCompleteTask ?>,<?= $decCompleteTask ?>],
                        backgroundColor: [
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384',
                            '#FF6384'
                        ]
                    },
                    {
                        label: 'Incomplete',
                        data: [4,5,6],
                        backgroundColor: [
                            '#36A2EB',
                            '#36A2EB',
                            '#36A2EB'
                        ]
                    },
                    {
                        label: 'Total',
                        data: [4,5,6],
                        backgroundColor: [
                            '#2aeb2e',
                            '#2aeb2e',
                            '#2aeb2e'
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
