<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Department;
use App\Models\RoleUser;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $params['departments'] = Department::all();
        $params['Tasks'] = count(Task::where('created_by', auth()->user()->id)->get());
        $params['Taskalls'] = Task::orderBy('id', 'ASC')->get();
        $params['Users'] = User::all();

        $params['comms'] = Comment::orderBy('id', 'DESC')->skip(0)->take(2)->get();

        $params['it'] = Task::where('department_id', 1)->count();
        $params['itdone'] = Task::where([['department_id', 1], ['status', 1]])->get()->count();
        $params['itnone'] = Task::where([['department_id', 1], ['status', 0]])->get()->count();
        $params['i'] = $params['itdone'] * 100;
        if ($params['i'] > 0) {
            $params['$perit'] = $params['i'] / $params['it'];
        } else {
            $params['perit'] = 0;
        }

        $params['net'] = Task::where('department_id', 2)->count();
        $params['netdone'] = Task::where([['department_id', 2], ['status', 1]])->get()->count();
        $params['netnone'] = Task::where([['department_id', 2], ['status', 0]])->get()->count();
        $params['n'] = $params['netdone'] * 100;
        if ($params['n'] > 0) {
            $params['pernet'] = $params['n'] / $params['net'];
        } else {
            $params['pernet'] = 0;
        }

        $params['cul'] = Task::where('department_id', 3)->count();
        $params['culdone'] = Task::where([['department_id', 3], ['status', 1]])->get()->count();
        $params['culnone'] = Task::where([['department_id', 3], ['status', 0]])->get()->count();
        $params['c'] = $params['culdone'] * 100;
        if ($params['c'] > 0) {
            $params['percul'] = $params['c'] / $params['cul'];
        } else {
            $params['percul'] = 0;
        }

        $params['sale'] = Task::where('department_id', 4)->count();
        $params['sldone'] = Task::where([['department_id', 4], ['status', 1]])->get()->count();
        $params['slnone'] = Task::where([['department_id', 4], ['status', 0]])->get()->count();
        $params['s'] = $params['sldone'] * 100;
        if ($params['s'] > 0) {
            $params['persl'] = $params['s'] / $params['sale'];
        } else {
            $params['persl'] = 0;
        }

        $params['user_id'] = auth()->user()->id;
        $params['MyTasks'] = Task::where('user_id', $params['user_id'])->get()->count();
        $params['ATasks'] = Task::where('user_id', $params['user_id'])->get();
        $params['mytasks'] = Task::where('user_id', auth()->user()->id)->get();
        $params['percentage'] = Task::where('user_id', auth()->user()->id)->get()->count();
        $params['done'] = Task::where([['user_id', $params['user_id']], ['status', 1]])->get()->count();
        $params['notdone'] = Task::where([['user_id', $params['user_id']], ['status', 0]])->get()->count();

        //Percentage of Completion
        $params['multi'] = $params['done'] * 100;
        if ($params['multi'] > 0) {
            $params['percent'] = $params['multi'] / $params['percentage'];
        } else {
            $params['percent'] = 0;
        }
        $params['user_id'] = auth()->user()->id;
        $params['done'] = Task::where([['user_id', $params['user_id']], ['status', 1]])->get()->count();
        $params['notdone'] = Task::where([['user_id', $params['user_id']], ['status', 0]])->get()->count();
        $params['departments'] = Department::all();


        $current_year = date('Y');


//*************************************All Tasks*******************************************************************
        $params['janTask'] = Task::TaskByMonth($params['user_id'], '01', $current_year);
        $params['febTask'] = Task::TaskByMonth($params['user_id'], '02', $current_year);
        $params['marTask'] = Task::TaskByMonth($params['user_id'], '03', $current_year);
        $params['aprTask'] = Task::TaskByMonth($params['user_id'], '04', $current_year);
        $params['mayTask'] = Task::TaskByMonth($params['user_id'], '05', $current_year);
        $params['junTask'] = Task::TaskByMonth($params['user_id'], '06', $current_year);
        $params['julTask'] = Task::TaskByMonth($params['user_id'], '07', $current_year);
        $params['augTask'] = Task::TaskByMonth($params['user_id'], '08', $current_year);
        $params['sepTask'] = Task::TaskByMonth($params['user_id'], '09', $current_year);
        $params['octTask'] = Task::TaskByMonth($params['user_id'], '10', $current_year);
        $params['novTask'] = Task::TaskByMonth($params['user_id'], '11', $current_year);
        $params['decTask'] = Task::TaskByMonth($params['user_id'], '12', $current_year);


//*************************************Completed Tasks*******************************************************************
        $params['janCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '01', $current_year);
        $params['febCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '02', $current_year);
        $params['marCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '03', $current_year);
        $params['aprCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '04', $current_year);
        $params['mayCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '05', $current_year);
        $params['junCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '06', $current_year);
        $params['julCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '07', $current_year);
        $params['augCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '08', $current_year);
        $params['sepCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '09', $current_year);
        $params['octCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '10', $current_year);
        $params['novCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '11', $current_year);
        $params['decCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '12', $current_year);

//*************************************InCompleted Tasks*******************************************************************
        $params['janInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '01', $current_year);
        $params['febInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '02', $current_year);
        $params['marInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '03', $current_year);
        $params['aprInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '04', $current_year);
        $params['mayInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '05', $current_year);
        $params['junInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '06', $current_year);
        $params['julInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '07', $current_year);
        $params['augInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '08', $current_year);
        $params['sepInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '09', $current_year);
        $params['octInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '10', $current_year);
        $params['novInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '11', $current_year);
        $params['decInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '12', $current_year);



        return view('Dashboard.User.myTask', $params);
    }

    public function myTasks()
    {
        $params['departments'] = Department::all();
        $params['comms'] = Comment::orderBy('id', 'DESC')->skip(0)->take(2)->get();
        $params['user_id'] = auth()->user()->id;
        $params['ATasks'] = Task::where('user_id', $params['user_id'])->get();
        $params['MyTasks'] = Task::where('user_id', $params['user_id'])->get()->count();
        $params['done'] = Task::where([['user_id', $params['user_id']], ['status', 1]])->get()->count();
        $params['notdone'] = Task::where([['user_id', $params['user_id']], ['status', 0]])->get()->count();
        $params['percentage'] = Task::where('user_id', auth()->user()->id)->get()->count();
        $multi = $params['done'] * 100;
        if ($multi > 0) {
            $params['percent'] = $multi / $params['percentage'];
        } else {
            $params['percent'] = 0;
        }

        $current_year = date('Y');

//*************************************All Tasks*******************************************************************
        $params['janTask'] = Task::TaskByMonth($params['user_id'], '01', $current_year);
        $params['febTask'] = Task::TaskByMonth($params['user_id'], '02', $current_year);
        $params['marTask'] = Task::TaskByMonth($params['user_id'], '03', $current_year);
        $params['aprTask'] = Task::TaskByMonth($params['user_id'], '04', $current_year);
        $params['mayTask'] = Task::TaskByMonth($params['user_id'], '05', $current_year);
        $params['junTask'] = Task::TaskByMonth($params['user_id'], '06', $current_year);
        $params['julTask'] = Task::TaskByMonth($params['user_id'], '07', $current_year);
        $params['augTask'] = Task::TaskByMonth($params['user_id'], '08', $current_year);
        $params['sepTask'] = Task::TaskByMonth($params['user_id'], '09', $current_year);
        $params['octTask'] = Task::TaskByMonth($params['user_id'], '10', $current_year);
        $params['novTask'] = Task::TaskByMonth($params['user_id'], '11', $current_year);
        $params['decTask'] = Task::TaskByMonth($params['user_id'], '12', $current_year);


//*************************************Completed Tasks*******************************************************************
        $params['janCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '01', $current_year);
        $params['febCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '02', $current_year);
        $params['marCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '03', $current_year);
        $params['aprCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '04', $current_year);
        $params['mayCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '05', $current_year);
        $params['junCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '06', $current_year);
        $params['julCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '07', $current_year);
        $params['augCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '08', $current_year);
        $params['sepCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '09', $current_year);
        $params['octCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '10', $current_year);
        $params['novCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '11', $current_year);
        $params['decCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '12', $current_year);

//*************************************InCompleted Tasks*******************************************************************
        $params['janInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '01', $current_year);
        $params['febInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '02', $current_year);
        $params['marInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '03', $current_year);
        $params['aprInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '04', $current_year);
        $params['mayInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '05', $current_year);
        $params['junInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '06', $current_year);
        $params['julInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '07', $current_year);
        $params['augInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '08', $current_year);
        $params['sepInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '09', $current_year);
        $params['octInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '10', $current_year);
        $params['novInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '11', $current_year);
        $params['decInCompleteTask'] = Task::inCompleteTaskByMonth($params['user_id'], '12', $current_year);

        return view('Dashboard.User.myTask', $params);
    }

    public function TasksAssign()
    {
        $params['Tasks'] = count(Task::where('created_by', auth()->user()->id)->get());
        $params['Taskalls'] = Task::orderBy('id', 'ASC')->get();
        $params['Users'] = User::all();
        $params['departments'] = Department::all();
        $params['comms'] = Comment::orderBy('id', 'DESC')->skip(0)->take(2)->get();
        $params['user_id'] = auth()->user()->id;
        $params['MyTasks'] = Task::where('created_by', $params['user_id'])->get()->count();
        $params['done'] = Task::where([['created_by', $params['user_id']], ['status', 1]])->get()->count();
        $params['notdone'] = Task::where([['created_by', $params['user_id']], ['status', 0]])->get()->count();
        $params['percentage'] = Task::where('created_by', auth()->user()->id)->get()->count();
        $multi = $params['done'] * 100;
        if ($multi > 0) {
            $params['percent'] = $multi / $params['percentage'];
        } else {
            $params['percent'] = 0;
        }

        $current_year = date('Y');

        $params['janCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '01', $current_year);
        $params['febCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '02', $current_year);
        $params['marCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '03', $current_year);
        $params['aprCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '04', $current_year);
        $params['mayCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '05', $current_year);
        $params['junCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '06', $current_year);
        $params['julCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '07', $current_year);
        $params['augCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '08', $current_year);
        $params['sepCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '09', $current_year);
        $params['octCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '10', $current_year);
        $params['novCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '11', $current_year);
        $params['decCompleteTask'] = Task::completeTaskByMonth($params['user_id'], '12', $current_year);

        return view('Dashboard.User.taskAssign', $params);
    }

    public function viewByDepartment($id)
    {
        $params['dept_task_id'] = Task::where('department_id', $id)->pluck('id')->toArray();
        $params['comments'] = Comment::whereIn('task_id', $params['dept_task_id'])->orderBy('id', 'DESC')->skip(0)->take(2)->get();
        $params['dept_tasks'] = Task::where('department_id', $id)->count();
        $params['dept_done'] = Task::where([['department_id', $id], ['status', 1]])->get()->count();
        $params['dept_incomplete'] = Task::where([['department_id', $id], ['status', 0]])->get()->count();
        if ($params['dept_done'] > 0) {
            $params['percentage_done'] = ($params['dept_done'] / $params['dept_tasks']) * 100;
        } else {
            $params['percentage_done'] = 0;
        }
        $params['users'] = User::where('department_id', $id)->get();
        $params['dept_name'] = Department::find($id)->name;
        return view('Departments.dashboard.dept_dashboard', $params);
    }

    public function ViewComments()
    {
        $params['comments'] = Comment::orderBy('id', 'DESC')->get();
        return view('Comments.index', $params);
    }

}
