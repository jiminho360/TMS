<div class="form-group row">
    <input type="hidden" name="user_id" value="{{$user->id}}">
    <div class="col-lg-4 col-md-4">
        <label for="first_name" class="control-label">First Name</label>
        <input class="form-control input-sm" id="first_name" onkeypress="return a(event);" name="first_name"
               value="{{$user->first_name}}"
               type="text" autocomplete="off" required>
    </div>
    <div class="col-lg-4 col-md-4">
        <label class="control-label" for="middle_name">Middle Name</label>
        <input class="form-control input-sm" id="middle_name" onkeypress="return a(event);" name="middle_name"
               value="{{$user->middle_name}}"
               type="text" autocomplete="off" required>
    </div>
    <div class="col-lg-4 col-md-4">
        <label class="control-label" for="last_name">Last Name</label>
        <input class="form-control input-sm" id="last_name" onkeypress="return a(event);" name="last_name"
               value="{{$user->last_name}}"
               type="text" autocomplete="off" required>
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-4 col-md-4">
        <label class="control-label" for="email">Email</label>
        <input class="form-control input-sm" id="email" autocomplete="off" name="email" type="email"
               value="{{$user->email}}" required>
    </div>
    <div class="col-lg-4 col-md-4">
        <label class="control-label" for="phone_no">Phone</label>
        <input class="form-control input-sm" id="phone_no" autocomplete="off" onkeypress="return isNumber(event)"
               name="phone_no" type="text" value="{{$user->phone_no}}" required>
    </div>
    <div class="col-lg-4 col-md-4">
        <label class="control-label" for="department_id">Department</label>
        <select class="form-control dd_select" id="department_id" name="department_id" required style="width: 100%">
            @foreach($departments as $dept)
                <option value="{{$dept->id}}" {{$dept->id == $user->department_id ? 'selected':''}}>{{$dept->name}}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-lg-8 col-md-8">
        <label class="control-label" for="role_id">Roles</label>
        <select class="form-control dd_select" id="role_id" name="role_id" required style="width: 100%">
            @foreach($roles as $role)
                <option value="{{$role->id}}" {{$role->id == $selected_role ? 'selected':''}}>{{$role->name}}</option>
            @endforeach
        </select>
    </div>
</div>
