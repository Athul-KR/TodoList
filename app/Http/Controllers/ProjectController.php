<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Todo;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //Creating project

    protected function project()
    {
        return view('project.project_create');
    }

    protected function project_save()
    {
        request()->validate([
            'title' => 'required|max:255', // Title is required and should not exceed 255 characters
        ]);

        $projects = Project::create(request(['title']));
        return redirect()->route('project.list')->with('message', 'Project Created Successfully');
    }

    protected function project_list()
    {
        $projects = Project::get();
        // $projects = Project::where('user_id', auth()->id())->get();
        return view('project.projectlist', compact('projects'));
    }
    protected function project_edit($projectId)
    {
        $projects = Project::find(decrypt($projectId));
        return view('project.projectedit', compact('projects'));
    }

    protected function project_update()
    {
        request()->validate([
            'title' => 'required|max:255', // Title is required and should not exceed 255 characters
        ]);

        Project::find(decrypt(request('project_id')))->update(request(['title']));
        return redirect()->route('project.list')->with('message', 'Project Updated Successfully');
    }

    protected function project_view($projectId)
    {
        $projects = Project::find(decrypt($projectId));
        return view('project.projectview', compact('projects'));
    }
}
