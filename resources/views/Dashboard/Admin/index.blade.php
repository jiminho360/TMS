@extends('layouts.app')


@section('title','Dashboard')

@section('content')
    <div>
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-book"></i></div>
                    <div class="count">{{$MyTasks}}</div>
                    <h3>My Tasks</h3>
                </div>
{{--                <a href="{{'User-Mytask'}}">--}}
{{--                    <button type="button" class="btn btn-primary btn-xs">View More...</button>--}}
{{--                </a>--}}

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
                    <div class="count">{{round($percent,2)}}</div>
                    <h3>Completion</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Task Summary</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                                <div class="x_content">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>

                                        <tr>
                                            <th>#</th>
                                            <th>Task Name</th>
                                            <th>Completion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ATasks as $key=>$ATask)
                                            <tr>
                                                <td width="3">{{++$key}}</td>
                                                <td>{{$ATask->name}}</td>
                                                <td width="2">{{round(\App\Models\Task::percentageDone($ATask->id))."%"}}</td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
