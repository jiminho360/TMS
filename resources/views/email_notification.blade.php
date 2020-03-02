<h4>Hello {{$user->first_name." ".$user->last_name}}</h4>
<p>You Have Been Assigned a new Project. Please see the following project details</p>
<p><strong>Name:</strong> {{$task->name}}</p>
<p><strong>Start Date:</strong> {{date('d M Y',strtotime($task->startDate))}}</p>
<p><strong>Expected End Date:</strong> {{date('d M Y',strtotime($task->endDate))}}</p>
<p><strong>Description:</strong> {{$task->description}}</p>
<p>Please Let me know if you have any questions: </p>
<p><strong>{{$task->assigner->first_name." ".$task->assigner->last_name}}</strong></p>
<p>Your Friendly Boss</p>
