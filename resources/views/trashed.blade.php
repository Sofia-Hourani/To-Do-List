
@extends('layout.master')

@section('index')
    <div class="main-content mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Trashed Tasks</h4>
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
                            <td>{{$task->is_completed}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
