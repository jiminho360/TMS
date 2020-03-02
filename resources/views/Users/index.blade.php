@extends('layouts.app')


@section('title','Users List')

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Users List</h2>
                <ul class="nav navbar-right panel_toolbox">
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
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Email</th>
                        {{--@if(\Illuminate\Support\Facades\Auth::user()->hasRole('academic_teacher'))--}}
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key=>$user)
                        <tr>
                            <td width="2">{{$key+1}}</td>
                            <td class="desc_name">{{$user->first_name." ".$user->middle_name." ".$user->last_name}}</td>
                            <td>{{$user->phone_no}}</td>
                            <td>{{$user->department->name}}</td>
                            <td>{{$user->email}}</td>
                            {{--                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('academic_teacher'))--}}
                            <td width="5">
                                <a href="{{url('users/edit/'.$user->id)}}" class="edit-btn"> Edit</a> |
                                <a href="{{url('users/delete/'.$user->id)}}" class="delete-btn"> Delete</a>
                            </td>
                            {{--@endif--}}
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
                <form action="{{url('users/store')}}" method="post">
                    @csrf
                    <div class="modal-header modal-header-color">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"><strong>Add User</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4">
                                <label for="first_name" class="control-label">First Name</label>
                                <input class="form-control input-sm" id="first_name" name="first_name"
                                       type="text" autocomplete="off" onkeypress="return a(event);" required>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label class="control-label" for="middle_name">Middle Name</label>
                                <input class="form-control input-sm" id="middle_name" name="middle_name"
                                       type="text" autocomplete="off" onkeypress="return a(event);" required>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label class="control-label" for="last_name">Last Name</label>
                                <input class="form-control input-sm" id="last_name" name="last_name"
                                       type="text" autocomplete="off" onkeypress="return a(event);" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4">
                                <label class="control-label" for="email">Email</label>
                                <input class="form-control input-sm" id="email" name="email" type="email"
                                       autocomplete="off" required>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label class="control-label" for="phone_no">Phone</label>
                                <input class="form-control input-sm" id="phone_no" onkeypress="return isNumber(event)"
                                       name="phone_no" type="text" autocomplete="off" required>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label class="control-label" for="department_id">Department<span
                                            style="color:red;">*</span></label>
                                <select class="form-control dd_select" id="department_id" name="department_id"
                                        required
                                        style="width: 100%">
                                    <option value="">---</option>
                                    @foreach($dept_id as $dept)
                                        <option value="{{$dept->id}}">{{$dept->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <label class="control-label" for="role_id">Roles<span
                                            style="color:red;">*</span></label>
                                <select class="form-control dd_select" id="role_id" name="role_id"
                                        required
                                        style="width: 100%">
                                    <option value="">---</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                        class="fa fa-close"></i>
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="edit" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{url('users/update')}}" method="post">
                    @csrf
                    <div class="modal-header modal-header-color">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"><strong> Edit User</strong></h4>
                    </div>
                    <div class="modal-body modal-edit">

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
            const dataURL = $(this).attr('href');
            $('.modal-edit').load(dataURL, function () {
                $('#edit').modal({show: true});
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

    </script>
@stop
