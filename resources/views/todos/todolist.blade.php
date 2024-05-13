@extends('layouts.menu')
@section('title','Todo List')
@section('content')

<div>
    <input type="hidden" value="{{ encrypt($decryptedProjectId) }}" name="project_id">
    <h1 name="title" class=" text-center mb-5 pb-5">{{$projects->title}}</h1>
</div>
@if(session()->has('message'))<p class="text-center text-success mb-3" id="message">{{session()->get('message')}}</p>
<script>
    setTimeout(function() {
        $('#message').fadeOut('fast');
    }, 3000); // 3 seconds
</script>
@endif

<div class="mt-5  d-flex align-items-end">
    <h3 class="align-items-end col-4">Todo List</h3>
    <ul class="nav nav-tabs col-8 justify-content-end">
        <li class="nav-item border">
            <a class=" nav-link {{ Route::currentRouteNamed('todo.list') ? 'active' : '' }}  " href="{{ route('todo.list',encrypt($projects->project_id))}}">Pending</a>
        </li>
        <?php
        // <li class="nav-item">
        // <a class="nav-link @activeRoute('your-route')" href="{{ route('your-route') }}">Pending</a>
        // </li>
        ?>
        <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteNamed('todo.completed') ? 'active' : '' }} me-1 " href="{{ route('todo.completed',encrypt($projects->project_id))}}" href=" #">Completed</a>
        </li>

        <div>
            <a href="{{ route('export.projects.todos',['projectId' => encrypt($decryptedProjectId)]) }}" class=" btn btn-success btn-m text-body mb-1 mx-1">Export</a>
        </div>
        <div>
            <a href="{{ route('todo.create',['project_id' =>encrypt($decryptedProjectId)]) }}" data-mdb-ripple-init class=" btn btn-success btn-m gradient-custom-3 text-body mb-1 mx-1">Create</a>
        </div>
        <div class="text-end">
            <a href="{{ route('project.list',encrypt($projects->project_id)) }}" class="btn btn-info mx-1">Back</a>
        </div>
    </ul>


</div>
<table class="table gradient-custom-3 shadow-lg text-center" style="border-radius: 13px;">
    <tr>
        <th scope="col">Title</th>
        <th scope="col">Date</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
        @forelse($tododetails as $todo)
        @if($todo->title)
        <tr>
            <td>{{$todo->title}}</td>
            <td>{{ date('d-M-Y', strtotime($todo->created_at)) }}</td>
            <td>
                <a href="{{route('todo.edit', encrypt($todo->todo_id))}}" class="btn btn-primary">Edit</a>
                <a href="{{route('todo.delete',['todo_id' => encrypt($todo->todo_id), 'projectId' => $decryptedProjectId])}}" class="btn btn-danger">Delete</a>
                @if($todo->status == 1)<a href="{{route('todo.complete', encrypt($todo->todo_id))}}" class="btn btn-success">Mark as Complete</a>@endif
            </td>
        </tr>
        @endif
        @empty
        <td></td>
        <td>No data Found</td>
        @endforelse
    </tbody>
</table>
@endsection