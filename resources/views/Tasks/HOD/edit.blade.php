<div class="form-group row">
    <input type="hidden" name="task_id" id="task_id" value="{{$task->id}}">
    <div class="col-md-4">
        <label for="name" class="control-label">Task Name</label>
        <input class="form-control input-sm" id="name" name="name" type="text"
               autocomplete="off" required value={{$task->name}}>
        {{--onkeypress="return isNumber(event)"--}}
    </div>
    <div class="col-md-4">
        <label for="priority" class="control-label">Task Priority</label>
        <select class="form-control dd_select" id="priority" name="priority"
                required
                style="width: 100%">
            @foreach($priorities as ['name'=>$value])
                <option value="{{$value}}" {{$value == $task->priority ? 'selected':''}}>{{$value}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="department_id" class="control-label">Department</label>
        <select class="form-control dd_select department_id" id="department_id" name="department_id"
                required
                style="width: 100%">
            @foreach($departments as $department)
                <option value="{{$department->id}}" {{$department->id == $task->department_id? 'selected':''}}>{{$department->name}}</option>

            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4">
        <label for="user_id" class="control-label">Assign To</label>
        <select class="form-control dd_select user_id" id="user_id" name="user_id" required
                style="width: 100%" >
            @foreach($users as $user)
                <option value="{{$user->id}}" {{$user->id == $task->user_id ? 'selected':''}}>{{$user->first_name." ".$user->last_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-4 col-md-4">
        <label class="control-label" for="startDate">Start Date</label>
        <input class="form-control input-sm datePickerBefore" id="startDate" name="startDate"
               type="text"
               autocomplete="off" onkeypress="return isNumber(event)" required value={{$task->startDate}}>
    </div>
    <div class="col-lg-4 col-md-4">
        <label class="control-label" for="endDate">End Date</label>
        <input class="form-control input-sm datePickerAfter" id="endDate" name="endDate"
               type="text"
               autocomplete="off" onkeypress="return isNumber(event)" required value={{$task->endDate}}>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-12">
        <label for="description" class="control-label">Description</label>
        <textarea class="form-control" id="description" name="description" >{{$task->description}}</textarea>
    </div>
</div>