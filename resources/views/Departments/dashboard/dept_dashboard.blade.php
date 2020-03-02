@extends('layouts.app')


@section('title','It Department')

@section('content')
    <div>
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-book"></i></div>
                    <div class="count">{{$dept_tasks}}</div>
                    <h3>Tasks</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-check-square"></i></div>
                    <div class="count">{{$dept_done}}</div>
                    <h3>Completed</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-spinner"></i></div>
                    <div class="count">{{$dept_incomplete}}</div>
                    <h3>Not Completed</h3>
                </div>
                 </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-percent"></i></div>
                    <div class="count">{{$percentage_done}}</div>
                    <h3 style="font-size:larger">Percentage of Completion</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$dept_name}} Department Tasks</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <a href="{{url('dashboard')}}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Tasks Informations</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Assignee</th>
                                            <th>#.Tasks</th>
                                            <th>Complete</th>
                                            <th>InComplete</th>
                                            <th>Percent</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $key=>$user)
                                            <tr>
                                            <th>{{$key+1}}</th>
                                            <td>{{$user->first_name}}</td>
                                            <td>{{\App\Models\Task::countByUserId($user->id)}}</td>
                                            <td>{{\App\Models\Task::countCompleteByUserId($user->id)}}</td>
                                            <td>{{\App\Models\Task::countInCompleteByUserId($user->id)}}</td>
                                            <td>{{\App\Models\Task::percentageByUserId($user->id)."%"}}</td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Tasks Comments</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    @foreach($comments as $comment)
                                        <ul class="list-unstyled msg_list">
                                            <li>
                                                <a href="#">
                        <span class="image">
                          <img src="/uploads/avatars/{{$comment->User->avatar}}" alt="img" />
                        </span>
                                                    <span>
                          <span>{{$comment->User->first_name ." ". $comment->User->middle_name }}</span>
                          <span class="time"><i class="fa fa-clock-o"> </i>{{" ".$comment->created_at->diffForHumans()}}</span>
                        </span>
                                                    <span class="message">{{$comment->description}}</span><br>
                                                    <span>Task: {{$comment->Task->name}}</span> &nbsp
                                                    <span> <p class="month pull-right">{{$comment->created_at->format('d')." ".$comment->created_at->format('M')}}</p>
                                                    </span>

                                                </a>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
