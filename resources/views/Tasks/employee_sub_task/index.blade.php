@extends('layouts.app')
@section('title','Sub task List')

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$task_name}} Ativities Lists</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{url('employee-task')}}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                    <button type="button" class="btn btn-primary btn-sm" data-target="#create" data-toggle="modal"><i
                                class="fa fa-plus-circle"></i> Add New
                    </button>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Percent</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subtasks as $key=>$subtask)
                        <tr>
                            <td style="width: 5%">{{$key + 1}}</td>
                            <td class="desc_name">{{$subtask->name}}</td>
                            <td width="4">
                                {{round($percent). '%'}}
                            </td>
                            @if($subtask->Status == "Not Done")
                                <td width="4">
                                    <a href="{{url('e-subtask/approve/'. $subtask->id)}}" class="btn-white">Done</a> |
                                    <a href="{{url('e-subtask/edit/' . $subtask->id)}}" class="edit-btn"> Edit</a> |
                                    <a href="{{url('e-subtask/destroy/'. $subtask->id)}}" class="delete-btn"> Delete</a>
                                </td>
                            @else
                                <td width="20%"><b> No Option</b> |
                                    <a href="{{url('e-subtask/remove/'. $subtask->id)}}" class="remove-btn">Remove</a>

                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" role="dialog" id="create" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{url('e-subtask/Store')}}" method="post">
                    @csrf
                    <input type="hidden" name="task_id" value="{{$task_id}}">
                    <div class="modal-header modal-header-color">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"><strong>Add Sub Task</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Name</label>
                                <input class="form-control" id="name" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="edit" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{url('e-subtask/update')}}" method="post">
                    @csrf
                    <div class="modal-header modal-header-color">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"><strong> Edit Sub Task</strong></h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('Scripts')
    <script>
        $('.edit-btn').on('click', function (e) {
            e.preventDefault();
            var dataURL = $(this).attr('href');
            $('.modal-body').load(dataURL, function () {
                $('#edit').modal({show: true});
            });
        });
        //Date Picker
        $(document).ready(function () {
            var DateToday = new Date();
            $('.datePicker').datepicker({
                orientation: "auto",
                todayBtn: "linked",
                keyboardNavigation: true,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                endDate: DateToday,
                format: "yyyy-mm-dd"
            });
        });


        $('#edit').on('shown.bs.modal', function () {
            let lesson;
            let nursery_id;

            $(".lesson").change(function () {
                lesson = $(this).val();
                nursery_id = $("#nursery_id").val();

                $.ajax({
                    url: '{{url('/grades/ajax/')}}',
                    type: "GET",
                    data: {d_lesson: lesson, d_nursery: nursery_id},
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $(".marks").val(data);
                    }
                });

            });

        });


        //For Deleting
        $(".delete-btn").click(function (e) {
            e.preventDefault();
            var User = $(this).closest('tr').children('td.desc_name').text().trim();

            Swal({
                title: 'Are you sure?',
                text: User + ' Will be Deleted!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it',
                confirmButtonColor: "#dd6b55"
            }).then((result) => {
                if (result.value) {

                    var Url = $(this).attr('href');
                    $(location).attr('href', Url);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                }
            })
        });

        //For Removing
        $(".remove-btn").click(function (e) {
            e.preventDefault();
            var User = $(this).closest('tr').children('td.desc_name').text().trim();

            Swal({
                title: 'Are you sure?',
                text: User + ' Will be Removed!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'No, keep it',
                confirmButtonColor: "#dd6b55"
            }).then((result) => {
                if (result.value) {

                    var Url = $(this).attr('href');
                    $(location).attr('href', Url);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                }
            })
        });

    </script>
@stop
