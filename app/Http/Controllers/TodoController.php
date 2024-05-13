<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class TodoController extends Controller
{
    //
    protected function todo_create($projectId)
    {

        $decryptedProjectId = decrypt($projectId);
        return view('todos.todocreate', compact('decryptedProjectId',));
    }

    protected function todo_save()
    {
        request()->validate([
            'title' => 'required|max:255', // Title is required and should not exceed 255 characters
        ]);

        $decryptedProjectId = decrypt(request('project_id'));
        $todoData = [
            'title' => request('title'),
            'project_id' => $decryptedProjectId,
        ];

        $todo = Todo::create($todoData);
        $decrypted = encrypt($decryptedProjectId);

        return redirect()->route('todo.list', ['projectId' => $decrypted])->with('message', "Todo Created Successfully");
    }

    protected function todo_list($projectId)
    {

        $decryptedProjectId = decrypt($projectId);
        $projects = Project::find($decryptedProjectId);
        $tododetails = Todo::where([['project_id', '=', $decryptedProjectId], ['status', '=', 1]])->latest()->get();
        return view('todos.todolist', compact('projects', 'tododetails', 'decryptedProjectId'));
    }
    protected function todo_completed($projectId)
    {

        $decryptedProjectId = decrypt($projectId);
        $projects = Project::find($decryptedProjectId);
        $tododetails = Todo::where([['project_id', '=', $decryptedProjectId], ['status', '=', 0]])->latest()->get();
        return view('todos.todolist', compact('projects', 'tododetails', 'decryptedProjectId'));
    }



    protected function todo_edit($todoId)
    {
        $todos = Todo::find(decrypt($todoId));
        return view('todos.todoedit', compact('todos'));
    }


    protected function todo_update()
    {
        request()->validate([
            'title' => 'required|max:255', // Title is required and should not exceed 255 characters
        ]);

        $todo = Todo::find(decrypt(request('todo_id')));

        $todo->update(request(['title']));


        $decryptedProjectId = encrypt($todo->project_id);

        return redirect()->route('todo.list', ['projectId' => $decryptedProjectId])->with('message', 'Todo updated successfully');
    }

    protected function todo_delete($todoId, $projectId)
    {
        $todo = Todo::find(decrypt($todoId));

        if ($todo) {
            $todo->delete();
            return redirect()->route('todo.list', ['projectId' => encrypt($projectId)])->with('message', 'Todo deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Todo not found');
        }
    }


    protected function todo_complete($todoId)
    {
        $todo = Todo::find(decrypt($todoId));

        if ($todo) {
            $todo->update(['status' => 0]);
            return redirect()->route('todo.list', ['projectId' => encrypt($todo->project_id)])->with('message', 'Todo marked as complete');
        } else {
            return redirect()->back()->with('error', 'Todo not found');
        }
    }

    public function exportTodos()
    {
        $projectId = decrypt(request('projectId'));
        $project = Project::findOrFail($projectId);

        // Debugging: Check if project ID is decrypted correctly
        // dd($projectId);

        // Debugging: Check if the project exists
        // dd($project);
        $decryptedProjectId = encrypt($projectId);
        $projects = Project::find($decryptedProjectId);
        $tododetails = Todo::where([['project_id', '=', $decryptedProjectId], ['status', '=', 1]])->latest()->get();


        // Debugging: Check if todos are fetched correctly
        // dd($todos);

        // Generate Markdown content
        $markdownContent = "# Project: " . $project->title . "\n\n";
        $markdownContent = $markdownContent . "## Todos\n\n";

        foreach ($tododetails as $todo) {
            $markdownContent .= "- " . $todo->title . "\n";
        }

        // Write Markdown content to a file
        $fileName = 'exported_todos_' . now()->format('Ymd_His') . '.md';
        File::put(public_path('exports/' . $fileName), $markdownContent);

        return response()->download(public_path('exports/' . $fileName))->deleteFileAfterSend(true);
    }
}
