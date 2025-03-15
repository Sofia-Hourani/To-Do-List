<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json(['tasks' => $tasks], 200);
    }

    /**
     * Store a newly created task.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'is_completed' => 'boolean'
        ]);

        $task = Task::create($request->all());

        return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
    }

    /**
     * Display the specified task.
     */
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json(['task' => $task], 200);
    }

    /**
     * Update the specified task.
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $request->validate([
            'title' => 'sometimes|max:255',
            'description' => 'sometimes',
            'due_date' => 'sometimes|date',
            'is_completed' => 'sometimes|boolean'
        ]);

        $task->update($request->all());

        return response()->json(['message' => 'Task updated successfully', 'task' => $task], 200);
    }

    /**
     * Remove the specified task.
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        if (Auth::user()->name === 'admin' || $task->is_completed) {
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully'], 200);
        }

        return response()->json(['error' => 'Only admin or completed tasks can be deleted'], 403);
    }

    /**
     * Get trashed tasks.
     */
    public function trashed()
    {
        $tasks = Task::onlyTrashed()->get();
        return response()->json(['trashed_tasks' => $tasks], 200);
    }
}
