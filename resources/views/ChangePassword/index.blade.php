@extends('layouts.app')
@section('title','Change Password')

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <h2>Change your Password</h2>
            <div class="x_title"></div>
                <form action="{{url('ChangePassword/update')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4">
                            <label for="old_password" class="control-label">Old Password</label>
                            <input class="form-control input-sm" id="old_password" name="old_password"
                                   type="text" autocomplete="off" required>
                            <label class="control-label" for="new_password">New Password</label>
                            <input class="form-control input-sm" id="new_password" name="new_password"
                                   type="text" autocomplete="off" required><br>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Change Password</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection

