@extends('layouts.app')


@section('title','User Task Lists')

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tasks Lists</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{url('delete-tasks')}}"  class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete All
                    </a> <button type="button" class="btn btn-primary btn-sm" data-target="#create" data-toggle="modal"><i
                            class="fa fa-plus-circle"></i> Add New
                    </button>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                       style="width: 100%">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Priority</th>
                        <th>Department</th>
                        <th>Assigned To</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $key=>$task)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td class="desc_name">{{$task->name}}</td>
                            <td>{{$task->priority}}</td>
                            <td>{{$task->department->name}}</td>
                            <td>{{$task->User->first_name." ".$task->User->last_name}}</td>
                            <td>{{$task->description}}</td>
                            <td>{{$task->startDate}}</td>
                            <td>{{$task->endDate}}</td>
                            <td>
                                <a href="{{url('task/edit/'.$task->id)}}" class="edit-btn"> Edit</a> |
                                {{--                                <a href="{{url('SubTask/'.$task->id)}}" class="btn-white"> Add SubTask</a>--}}
                                <a href="{{url('task/destroy/'.$task->id)}}" class="delete-btn"> Delete</a>

                            </td>
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
                <form action="{{url('tasks/store')}}" method="post">
                    @csrf
                    <div class="modal-header modal-header-color">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"><strong>Add Task Information</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="name" class="control-label">Task Name</label>
                                <input class="form-control input-sm" id="name" name="name" type="text"
                                       autocomplete="off" required>
                                {{--onkeypress="return isNumber(event)"--}}
                            </div>
                            <div class="col-md-4">
                                <label for="priority" class="control-label">Task Priority</label>
                                <select class="form-control dd_select" id="priority" name="priority"
                                        required
                                        style="width: 100%">
                                    <option value="">----</option>
                                    @foreach($priorities as ['name'=>$value])
                                        <option value="{{$value}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="department_id" class="control-label">Department</label>
                                <select class="form-control dd_select" id="department_id" name="department_id"
                                        required
                                        style="width: 100%">
                                    <option value="">----</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="user_id" class="control-label">Assign To</label>
                                <select class="form-control dd_select" id="user_id" name="user_id" required
                                        style="width: 100%">
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label class="control-label" for="startDate">Start Date</label>
                                <input class="form-control input-sm datePickerBefore" id="startDate" name="startDate"
                                       type="text"
                                       autocomplete="off" onkeypress="return isNumber(event)" required>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label class="control-label" for="endDate">End Date</label>
                                <input class="form-control input-sm datePickerAfter" id="endDate" name="endDate"
                                       type="text"
                                       autocomplete="off" onkeypress="return isNumber(event)" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="description" class="control-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                    class="fa fa-close"></i>
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" role="dialog" id="edit_modal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{url('task/update')}}" method="post">
                    @csrf
                    <div class="modal-header modal-header-color">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"><strong> Edit Task Information</strong></h4>
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
                $('#edit_modal').modal({show: true});
            });
        });
        //Populating the User Based on Department
        $('#department_id').on('change', function () {
            const deptID = $(this).val();
            $.ajax({
                url: '{{url('/ajax/user-by-department/')}}',
                type: "GET",
                data: {department_id: deptID},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    const user = $('#user_id');
                    user.empty();
                    user.append('<option value="">Select Name</option>');
                    $.each(data, function (key, value) {
                        user.append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });

        $('#edit_modal').on('shown.bs.modal',function () {
            $('.dd_select').select2();

            //Populating the User Based on Department
            $('.department_id').on('change', function () {
                const deptID = $(this).val();
                $.ajax({
                    url: '{{url('/ajax/user-by-department/')}}',
                    type: "GET",
                    data: {department_id: deptID},
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        const user = $('.user_id');
                        user.empty();
                        user.append('<option value="">Select Name</option>');
                        $.each(data, function (key, value) {
                            user.append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            });
        });

        //Confirm Delete Modal
        $(".delete-btn").click(function (e) {
            e.preventDefault();
            const User = $(this).closest('tr').children('td.desc_name').text().trim();
            const Url = $(this).attr('href');
            deleteConfirm(User, Url);
        });


        //Date Picker
        datePickerLoadBefore();
        datePickerLoadAfter();
    </script>
@stop

