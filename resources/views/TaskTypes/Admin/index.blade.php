@extends('layouts.app')


@section('title','Dashboard')

@section('content')
    <div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Departments Lists</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <a href="{{url('dashboard')}}" type="button" class="btn btn-primary btn-sm"><i
                                    class="fa fa-backward"></i> Go Back
                            </a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row top_tiles">
                            @foreach($departs as $depart)
                                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">

                                    <div class="tile-stats">
                                        <div class="icon"><i class="fa fa-book"></i></div>
                                        <div class="count">0</div>
                                        <h3>{{$depart->name}} Tasks</h3>
                                    </div>

                                    <a href="#">
                                        <button type="button" class="btn btn-primary btn-xs">View More...</button>
                                    </a>

                                </div>  @endforeach
                        </div>
                    </div>
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
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <div class="demo-container" style="height:280px">
                                <div id="chart_plot_02" class="demo-placeholder"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
