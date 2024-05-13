<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Todo;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportTodos()
    {
        $project = Project::findOrFail(decrypt(request('projectId')));
        $tododetails = Todo::where('project_id', $project->id)->latest()->get();

        // Generate Markdown content
        $markdownContent = "# Project: " . $project->title . "\n\n";
        $markdownContent .= "## Pending Todos\n\n";
        foreach ($tododetails->where('status', 1) as $todo) {
            $markdownContent .= "- [ ] " . $todo->title . "\n";
        }
        $markdownContent .= "\n## Completed Todos\n\n";
        foreach ($tododetails->where('status', 0) as $todo) {
            $markdownContent .= "- [x] " . $todo->title . "\n";
        }

        // Write Markdown content to a file
        $fileName = 'exported_todos_' . now()->format('Ymd_His') . '.md';
        File::put(public_path('exports/' . $fileName), $markdownContent);

        return response()->download(public_path('exports/' . $fileName))->deleteFileAfterSend(true);
    }



    // public function exportProjectsTodos()
    // {
    //     $projects = Project::with('todos')->get();
    //     $markdownContent = '';

    //     foreach ($projects as $project) {
    //         $markdownContent .= "# {$project->title}\n\n";

    //         foreach ($project->todos as $todo) {
    //             $status = $todo->completed ? 'Completed' : 'Pending';
    //             $markdownContent .= "- [{$status}] {$todo->title}\n";
    //         }

    //         $markdownContent .= "\n";
    //     }

    //     // Write to Markdown file
    //     $fileName = 'projects_todos.md';
    //     $fileContent = $markdownContent;

    //     file_put_contents($fileName, $fileContent);

    //     return redirect()->back()->with('success', 'Projects and todos exported to projects_todos.md');
    // }



}
