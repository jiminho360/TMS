@extends('layouts.app')
@section('title','Task Progress')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Task Progress</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{url('dashboard')}}" type="button" class="btn btn-primary btn-sm"><i
                            class="fa fa-backward"></i> Go Back
                    </a>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-responsive"
                       class="table table-striped table-condensed table-bordered dt-responsive nowrap"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Priority</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Timeline</th>
                        <th>Subtask Completion</th>
                        <th>Progress</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $key=>$task)
                        <tr>
                            <td width="1">{{$key+1}}</td>
                            <td class="desc_name">{{$task->name}}</td>
                            <td width="5">{{$task->priority}}</td>
                            <td width="8">{{$task->department->name}}</td>
                            @if($task-> Status == 1)
                                <td width="8%" align="center"><span class="label label-success">Done</span></td>
                            @else
                                <td width="8%" align="center"><span class="label label-danger">Not Done</span></td>
                            @endif
                            @php
                                $sdate = $task->startDate;
                                $fdate = $task->endDate;
                                $datetime1 = new DateTime($sdate);
                                $datetime2 = new DateTime($fdate);
                                $interval = $datetime1->diff($datetime2);
                                $days = $interval->format('%R%a');
                                $today = new DateTime(strtotime(date('Y m d')));
                                $date_diff = $today->diff($datetime2);
                                $date_diff = $date_diff->format('%R%a');
                                $days_remain = $today->diff($datetime2)->format('%a');
                            @endphp
                            @if($task-> Status != 1)
                                @if($days <= 30 AND $days > 14 AND $date_diff > 14)
                                    <td width="2" bgcolor="green" style="color: white">
                                        {{$days_remain." "."days remain"}}
                                    </td>
                                @elseif($days <= 30  AND $days > 14 AND $date_diff < 14  AND $date_diff >= 0)
                                    <td width="2" bgcolor="#FFBF00" style="color: white">
                                        {{$days_remain." "."days remain"}}
                                    </td>
                                @elseif($days <= 14 AND $date_diff >= 3)
                                    <td width="2" bgcolor="green" style="color: white">
                                        {{$days_remain." "."days remain"}}
                                    </td>
                                @elseif($days <= 14 AND $date_diff < 3 AND $date_diff >= 0)
                                    <td width="2" bgcolor="#FFBF00" style="color: white">
                                        {{$days_remain." "."days remain"}}
                                    </td>
                                @elseif($date_diff < 0)
                                    <td width="2" bgcolor="red" style="color: white">
                                        {{$days_remain." "."days exceeded"}}
                                    </td>
                                @endif
                            @else
                                <td width="8%" align="center"><span class="label label-success">Complete</span></td>
                            @endif
                            @if($task-> Status != 1)
                            <td width="5%" align="center">{{\App\Models\EsubTask::CountCompletedSubTasks($task->id)}} of {{\App\Models\EsubTask::CountSubTasks($task->id)}}</td>
                            @else
                                <td width="5%" align="center">Completed</td>
                            @endif
                            <td width="5%" align="right">{{\App\Models\Task::percentageDone($task->id)."%"}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
