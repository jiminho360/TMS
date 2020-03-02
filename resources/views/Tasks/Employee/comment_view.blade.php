<div class="form-group row">
    <div class="col-md-12">
        <input type="hidden" name="task_id" value="{{$task_id}}">
        <input type="hidden" name="assigned_to" value="{{$assign_to}}">
        <input type="hidden" name="created_by" value="{{auth()->user()->id}}">
        <label for="description" class="control-label"></label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
</div>
