@extends('layout.master')

@section('index')
    <div class="main-content mt-5">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @elseif(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">

            <div class="card-header">

                <div class="row">
                    <div class="col-md-6">
                        <h4>All Task</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success" href="{{ route('tasks.create') }}">Create</a>
                        <a class="btn btn-warning" href="{{ route('tasks.trashed') }}">Trashed</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead style="background: #f2f2f2">
                    <tr>
                        <th scope="col" >#</th>
                        <th scope="col" >Title</th>
                        <th scope="col" >Description</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">User_Id</th>
                        <th scope="col">Completed</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <th scope="row">{{$task->id}}</th>
                            <td>{{$task->title}}</td>
                            <td>{{$task->description}}</td>
                            <td>{{$task->due_date}}</td>
                            <td>{{$task->user->name}}</td>
                            <td>@if($task->is_completed ==true)
                                    Done
                                @else
                                    Not Done
                                @endif
                            </td>
                            <td >
                                <a class="btn btn-sm btn-primary" href="{{ route('tasks.edit', $task->id) }}">Edit</a>
                                <a class="btn btn-sm btn-success" href="{{ route('tasks.show', $task->id) }}">Show</a>
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
