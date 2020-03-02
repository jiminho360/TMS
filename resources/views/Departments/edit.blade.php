<div class="form-group row">
    <input type="hidden" name="department_id" value="{{$department->id}}">
    <div class="col-lg-12 col-md-12">
        <label for="name" class="control-label">Name</label>
        <input class="form-control input-sm" id="name" onkeypress="return a(event);" name="name" value="{{$department->name}}"
               type="text" autocomplete="off" required>
    </div>
</div>
