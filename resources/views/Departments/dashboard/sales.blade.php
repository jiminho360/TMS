@extends('layouts.app')


@section('title','Sales Department')

@section('content')
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Sales Department Tasks</h2>
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
                                            <th>Department</th>
                                            <th>#.Tasks</th>
                                            <th>Complete</th>
                                            <th>InComplete</th>
                                            <th>Percent</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>1</th>
                                            <td>IT</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><a class="btn btn-primary btn-xs" href="#">View</a></td>
                                        </tr>
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
                          <img src="/uploads/avatars/{{$comm->User->avatar}}" alt="img" />
                        </span>
                                                    <span>
                          <span>{{$comm->User->first_name ." ". $comm->User->middle_name }}</span>
                          <span class="time"><i class="fa fa-clock-o"> </i>{{" ".$comm->created_at->diffForHumans()}}</span>
                        </span>
                                                    <span class="message">{{$comm->description}}</span><br>
                                                    <span>Task: {{$comm->Task->name}}</span> &nbsp
                                                    <span> <p class="month pull-right">{{$comm->created_at->format('d')." ".$comm->created_at->format('M')}}</p>
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
