@extends('layouts.app')


@section('title','Employee Task Lists')

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tasks Lists</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                       style="width: 100%">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Assigner</th>
                        <th>Assigner</th>
                        <th>Assigner</th>
                        <th>Assigner</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $key=>$task)
                        <tr>
                            <td width="2">{{$key + 1}}</td>
                            <td class="desc_name">{{$task->name}}</td>
                            <td>{{$task->description}}</td>
                            <td width="8">{{$task->assigner->first_name." ".$task->assigner->last_name}}</td>
                            {{--                           <td width="4">{{$task->Status}}</td>--}}
                            @if($task-> Status == 1)
                                <td width="8%" align="center"><span class="label label-success">Done</span></td>
                            @else
                                <td width="8%" align="center"><span class="label label-danger">Not Done</span></td>
                            @endif
                            <td></td>
                            <td></td>
                            <td></td>
                            <td width="5">
                                @if($task-> Status == 0)
                                    <a href="{{url('activate/'.$task->id)}}"
                                       class="btn btn-success btn-xs">Done</a>|
                                    <a href="{{url('task-comment/'.$task->id)}}"
                                       class="btn btn-primary btn-xs edit">Comment</a>|
                                    <a href="{{url('e-subtask/'.$task->id)}}" class="btn btn-default btn-xs">Sub
                                        Task</a>

                                @else
                                    <a href="{{url('task-comment/'.$task->id)}}"
                                       class="btn btn-primary btn-xs edit">Comment</a>
                                @endif </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" role="dialog" id="edit_modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{url('task-comment')}}" method="post">
                    @csrf
                    <div class="modal-header modal-header-color">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"><strong>Task Comments</strong></h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Send Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('Scripts')
    <script>
        $('.edit').on('click', function (e) {
            e.preventDefault();
            const dataURL = $(this).attr('href');
            $('.modal-body').load(dataURL, function () {
                $('#edit_modal').modal({show: true});
            });
        });

        $(".btn-white").click(function (e) {
            e.preventDefault();
            const User = $(this).closest('tr').children('td.desc_name').text().trim();

            Swal({
                title: 'Are you sure?',
                text: User + ' Task Will be Approved!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve it!',
                cancelButtonText: 'No, keep it',
                confirmButtonColor: "#dd6b55"
            }).then((result) => {
                if (result.value) {

                    const Url = $(this).attr('href');
                    $(location).attr('href', Url);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                }
            })
        });


    </script>

@stop

