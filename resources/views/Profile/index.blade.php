@extends('layouts.app')
@section('title','My Profile')

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <h2>{{$user->first_name}}'s Profile</h2>
            <div class="x_title"></div>
            <img src="/uploads/avatars/{{$user->avatar}}" style="width: 150px; height: 150px; float: left; border-radius: 50%; margin-right: 25px">
            <form enctype="multipart/form-data" action="{{url('profileChange')}}" method="post">
                @csrf
                <div class="form-group row"><br>
                    <div class="col-md-6">
                        <h2>Update file Image</h2>
                        <input type="file" name="avatar"><br>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save">&nbsp</i>Upload</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

