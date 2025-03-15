
@extends('layout.master')

@section('index')
    <div class="main-content mt-5">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>
                            create a task
                        </h4>
                        <a class="btn btn-success" href="{{route('tasks.index')}}">Back</a>
                    </div>

                </div>

            </div>

            <div class="card-body">

                <form action="{{route('tasks.store')}}" method="Post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Deadline</label>
                        <input type="date" class="form-control" name="due_date">
                    </div>
                    <div class="form-group mt-3">
                        <label for="">user_id</label>
                        <input type="number" class="form-control" name="user_id">
                    </div>
                    <div class="form-group mt-3">
                        <label for="is_completed">Is_Completed</label>
                        <input type="hidden" name="is_completed" value="0">
                        <input type="checkbox" name="is_completed" value="1" class="form-check-input">
                    </div>

                    <div class="form-group mt-3">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

