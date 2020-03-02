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
                <a href="{{'User-Mytask'}}">
                    <button type="button" class="btn btn-primary btn-xs">View More...</button>
                </a>

            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-check-square"></i></div>
                    <div class="count">{{$done}}</div>
                    <h3>Completed</h3>
                </div>
                <a href="{{'Completed'}}">
                    <button type="button" class="btn btn-primary btn-xs">View More...</button>
                </a>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-spinner"></i></div>
                    <div class="count">{{$notdone}}</div>
                    <h3>Not Completed</h3>
                </div>
                <a href="{{'NotCompleted'}}">
                    <button type="button" class="btn btn-primary btn-xs">View More...</button>
                </a></div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-percent"></i></div>
                    <div class="count">{{round($percent,2)}}</div>
                    <h3 style="font-size:larger">Percentage of Completion</h3>
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
                                            <th>Department</th>
                                            <th>#.Tasks</th>
                                            <th>Complete</th>
                                            <th>InComplete</th>
                                            <th>Percent</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($departments as $key=>$department)
                                            <tr>
                                                <th>{{++$key}}</th>
                                                <td>{{$department->name}}</td>
                                                <td>{{\App\Models\Task::countByDeptId($department->id)}}</td>
                                                <td>{{\App\Models\Task::countCompleteByDeptId($department->id)}}</td>
                                                <td>{{\App\Models\Task::countInCompleteByDeptId($department->id)}}</td>
                                                <td>{{\App\Models\Task::percentageByDeptId($department->id)."%"}}</td>
                                                {{--                                                <td>{{$perit}}%</td>--}}
                                                {{--                                            @else--}}
                                                {{--                                                <td>0%</td>--}}
                                                {{--                                            @endif--}}
                                                <td><a class="btn btn-primary btn-xs" href="{{url('dept-dashboard/'.$department->id)}}">View</a></td>
                                            </tr>
                                        @endforeach
                                        {{-- <tr>
                                             <th>2</th>
                                             <td>Network</td>
                                             <td>{{$net}}</td>
                                             <td>{{$netdone}}</td>
                                             <td>{{$netnone}}</td>
                                             @if($pernet>0)
                                                 <td>{{$pernet}}%</td>
                                             @else
                                                 <td>0%</td>
                                             @endif
                                             <td><a class="btn btn-primary btn-xs" href="{{url('Network')}}">View</a>
                                             </td>
                                         </tr>
                                         <tr>
                                             <th>3</th>
                                             <td>Culture</td>
                                             <td>{{$cul}}</td>
                                             <td>{{$culdone}}</td>
                                             <td>{{$culnone}}</td>
                                             @if($percul>0)
                                                 <td>{{$percul}}%</td>
                                             @else
                                                 <td>0%</td>
                                             @endif
                                             <td><a class="btn btn-primary btn-xs" href="{{url('Culture')}}">View</a>
                                             </td>
                                         </tr>
                                         <tr>
                                             <th>4</th>
                                             <td>Sales</td>
                                             <td>{{$sale}}</td>
                                             <td>{{$sldone}}</td>
                                             <td>{{$slnone}}</td>
                                             @if($persl>0)
                                                 <td>{{$persl}}%</td>
                                             @else
                                                 <td>0%</td>
                                             @endif
                                             <td><a class="btn btn-primary btn-xs" href="{{url('Sales')}}">View</a></td>
                                         </tr>--}}
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
                                    @foreach($comms as $comm)
                                        <ul class="list-unstyled msg_list">
                                            <li>
                                                <a href="#">
                        <span class="image">
                          <img src="/uploads/avatars/{{$comm->User->avatar}}" alt="img"/>
                        </span>
                                                    <span>
                          <span>{{$comm->User->first_name ." ". $comm->User->middle_name }}</span>
                          <span class="time"><i
                                  class="fa fa-clock-o"> </i>{{" ".$comm->created_at->diffForHumans()}}</span>
                        </span>
                                                    <span class="message">{{$comm->description}}</span><br>
                                                    <span>Task: {{$comm->Task->name}}</span> &nbsp
                                                    <span> <p
                                                            class="month pull-right">{{$comm->created_at->format('d')." ".$comm->created_at->format('M')}}</p>
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
