<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TodoController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Define root route
Route::get('/', [UserController::class, 'login'])->name('root.login');

Route::group(['prefix' => 'user'], function () {
    // User Login
    Route::get('login', [LoginController::class, 'login'])->name('user.login');
    Route::post('do-login', [LoginController::class, 'do_login'])->name('user.dologin');
    //Logout
    Route::get('logout', [LoginController::class, 'logout'])->name('user.logout');
    // User Create
    Route::get('create', [UserController::class, 'create'])->name('user.create');
    Route::post('user-save', [UserController::class, 'save'])->name('user.save');
});

//Middleware grouping
Route::group(['middleware' => 'user_auth'], function () {

    // Projects
    Route::group(['prefix' => 'project'], function () {
        // Route::get('todo-list/{project_id}', [ProjectController::class, 'project'])->name('project.create');
        Route::get('project-create', [ProjectController::class, 'project'])->name('project.create');
        Route::post('project-save', [ProjectController::class, 'project_save'])->name('project.save');
        Route::get('project-list', [ProjectController::class, 'project_list'])->name('project.list');
        Route::get('project-edit/{project_id}', [ProjectController::class, 'project_edit'])->name('project.edit');
        Route::post('project-update', [ProjectController::class, 'project_update'])->name('project.update');
        Route::get('project-view/{project_id}', [ProjectController::class, 'project_view'])->name('project.view');
    });

    //Export
    Route::get('export/projects/todos', [TodoController::class, 'exportTodos'])->name('export.projects.todos');


    //Todos
    Route::group(['prefix' => 'todo'], function () {
        Route::get('todo-list/{projectId}', [TodoController::class, 'todo_list'])->name('todo.list');
        Route::get('todo-list-completed/{projectId}', [TodoController::class, 'todo_completed'])->name('todo.completed');
        Route::get('create/{project_id}', [TodoController::class, 'todo_create'])->name('todo.create');
        Route::post('todo-save', [TodoController::class, 'todo_save'])->name('todo.save');
        Route::get('todo-edit/{todo_id}', [TodoController::class, 'todo_edit'])->name('todo.edit');
        Route::post('todo-update', [TodoController::class, 'todo_update'])->name('todo.update');
        Route::get('todo-delete/{todo_id}/{projectId}', [TodoController::class, 'todo_delete'])->name('todo.delete');
        Route::get('todo-complete/{todo_id}', [TodoController::class, 'todo_complete'])->name('todo.complete');
    });
});
