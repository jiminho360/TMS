@extends('layouts.app')


@section('title','Department List')

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Departments List</h2>
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
                        <th>Name</th>
                        {{--@if(\Illuminate\Support\Facades\Auth::user()->hasRole('academic_teacher'))--}}
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($departments as $key=>$department)
                        <tr>
                            <td width="2">{{$key+1}}</td>
                            <td class="desc_name">{{$department->name}}</td>
                            {{--                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('academic_teacher'))--}}
                            <td width="5">
                                <a href="{{url('department/edit/'.$department->id)}}" class="edit-btn"> Edit</a> |
                                <a href="{{url('department/delete/'.$department->id)}}" class="delete-btn"> Delete</a>

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
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{url('department/store')}}" method="post">
                    @csrf
                    <div class="modal-header modal-header-color">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"><strong>Add Department</strong></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label" for="name">Name</label>
                                <input class="form-control input-sm" id="name" name="name" type="text"
                                       autocomplete="off" required>
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
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{url('department/update')}}" method="post">
                    @csrf
                    <div class="modal-header modal-header-color">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title"><strong> Edit Department</strong></h4>
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
                text: User + ' Department Will be Deleted!',
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
