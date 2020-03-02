<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'AuthenticationController@loginIndex');
Route::post('login-user', 'AuthenticationController@Login');
//Route::post('login-user', [ 'as' => 'login-user', 'uses' => 'AuthenticationController@Login']);
Route::get('logout', 'AuthenticationController@logout');

Route::group(['middleware' => ['preventbackbutton', 'auth']], function () {
Route::get('dashboard', 'HomeController@home');
Route::get('dashboard_myTask', 'HomeController@myTasks');
Route::get('dashboard_tasksAssign', 'HomeController@TasksAssign');
});
//Route::get('login-user', ['as'=>'login','uses'=>'AuthenticationController@Login1']);
Route::middleware('auth')->group(function () {
    Route::get('ViewComments','HomeController@ViewComments');

    Route::get('users', 'UsersController@index');
    Route::post('users/store', 'UsersController@store');
    Route::get('users/edit/{id}', 'UsersController@edit');
    Route::get('users/delete/{id}', 'UsersController@destroy');
    Route::post('users/update', 'UsersController@update');

    Route::get('departments', 'DepartmentsController@index');
    Route::post('department/store', 'DepartmentsController@store');
    Route::get('department/edit/{id}', 'DepartmentsController@edit');
    Route::get('department/delete/{id}', 'DepartmentsController@destroy');
    Route::post('department/update', 'DepartmentsController@update');

    Route::get('comment/{id}', 'CommentsController@index');
    Route::get('comments', 'CommentsController@index');
    Route::get('comments', 'CommentsController@index');


    Route::get('employee-task', 'Tasks\EmployeeController@index');
    Route::get('comm/{id}', 'Tasks\EmployeeController@index');
    Route::get('task-comment/{id}', 'Tasks\EmployeeController@comment_load');
    Route::post('task-comment', 'Tasks\EmployeeController@post_comment');
    Route::post('employee-sub-task', 'Tasks\EmployeeController@subTaskLoad');


    Route::get('tasks', 'TasksController@index');
    Route::get('User-task', 'TasksController@Supervisor');
    Route::get('User-Mytask', 'TasksController@SupervisorTasks');
    Route::get('Completed', 'TasksController@Completed');
    Route::get('NotCompleted', 'TasksController@NotCompleted');
    Route::get('AllCompleted', 'TasksController@AllCompleted');
    Route::get('AllNotCompleted', 'TasksController@AllNotCompleted');
    Route::get('User-progress', 'TasksController@Progress');
    Route::post('tasks/store', 'TasksController@store');
    Route::get('task/activate/{id}', 'TasksController@activate');
    Route::get('task/edit/{id}', 'TasksController@edit');
    Route::post('task/update', 'TasksController@update');
    Route::get('task/destroy/{id}', 'TasksController@destroy');
    Route::get('sub-task/{id}', 'TasksController@Subtask');
    Route::get('activate/{id}', 'TasksController@activate');
    Route::get('delete-tasks', 'TasksController@deleteAll');

//ChangePassword
    Route::get('ChangePassword', 'UsersController@ChangePasswordIndex');
    Route::post('ChangePassword/update', 'UsersController@ChangePassword');
    Route::get('profile', 'UsersController@profile');
    Route::post('profileChange', 'UsersController@update_avatar');

//Ajax Routes
    Route::get('ajax/user-by-department/', 'DepartmentsController@getUsers');

    Route::get('SubTask/{id}', 'SubTaskController@index');
    Route::post('SubTask/Store', 'SubTaskController@store');
    Route::get('Subtask/edit/{id}', 'SubTaskController@edit');
    Route::post('Subtask/update', 'SubTaskController@update');
    Route::get('Subtask/destroy/{id}', 'SubTaskController@destroy');

    Route::get('e-subtask/{id}', 'Tasks\EsubTaskController@index');
    Route::post('e-subtask/Store', 'Tasks\EsubTaskController@store');
    Route::get('e-subtask/edit/{id}', 'Tasks\EsubTaskController@edit');
    Route::post('e-subtask/update', 'Tasks\EsubTaskController@update');
    Route::get('e-subtask/destroy/{id}', 'Tasks\EsubTaskController@destroy');
    Route::get('e-subtask/approve/{id}', 'Tasks\EsubTaskController@approve');
    Route::get('e-subtask/remove/{id}', 'Tasks\EsubTaskController@remove');

    Route::get('TaskTypes', 'Tasks\TaskTypeController@index');
    Route::get('viewed', 'Tasks\TaskTypeController@viewed');


    Route::get('dept-dashboard/{id}', 'HomeController@viewByDepartment');


});
