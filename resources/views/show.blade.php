@extends('layout.master')
@section('index')
    <div class="main-content mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Show Task</h5>
                <div>
                    <a class="btn btn-success" href="{{route('tasks.create')}}">Create</a>
                    <a class="btn btn-warning" href="{{route('tasks.trashed')}}">Trashed</a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td>id</td>
                        <td>{{$task->id}}</td>
                    </tr>
                    <tr>
                        <td>title</td>
                        <td>{{$task->title}}</td>
                    </tr>
                    <tr>
                        <td>description</td>
                        <td>{{$task->description}}</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td>{{$task->user->name}}</td>
                    </tr>
                    <tr>
                        <td>completed</td>
                        <td>@if($task->is_completed ==true)
                                Done
                            @else
                                Not Done
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
