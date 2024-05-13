@extends('layouts.menu')
@section('title','Project Listing')
@section('content')
<h1 class="text-center mb-3">Project Listing</h1>
@if(session()->has('message'))<p class="text-center text-success mt-5" id="message">{{session()->get('message')}}</p>
<script>
    setTimeout(function() {
        $('#message').fadeOut('fast');
    }, 3000); // 3 seconds
</script>
@endif
<div class="d-flex flex-column mt-5 align-items-end w-50 m-auto h-100">
    <div class="mb-3 mt-5">
        <a href="{{ route('project.create') }}" data-mdb-ripple-init class="btn btn-success btn-m gradient-custom-3 text-body">Create</a>
    </div>
    <table class="table gradient-custom-3 border-light shadow-lg text-center" style="border-radius: 13px;">

        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Created Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse($projects as $project)
            @if($project->title)
            <tr>
                <td>{{$project->title}}</td>
                <td>{{date('d-M-Y', strtotime($project->created_at))}}</td>


                <td>
                    <a href="{{route('project.edit', encrypt($project->project_id))}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('project.view', encrypt($project->project_id))}}" class="btn btn-success">View</a>
                    <a href="{{route('todo.list', encrypt($project->project_id))}}" class="btn btn-warning">Todos</a>
                </td>
            </tr>
            @endif
            @empty
            <td></td>
            <td>No Data Found</td>
            @endforelse


        </tbody>
    </table>
</div>
@endsection