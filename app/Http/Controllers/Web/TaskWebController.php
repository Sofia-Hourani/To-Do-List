<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaskWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Cache::remember('tasks', 60, function () {
            return Task::latest()->get();
        });
        return view('index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $tasks = Task::all();

        if (Auth::user()->name==='admin') {
            return view('create',compact('tasks'));
        }
        return redirect()->route('tasks.index')->with('error', 'Only admin can add tasks.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'user_id' => 'required',
            'is_completed' => 'required'

        ]);

        $task=new Task();

        $task->title=$request->title;
        $task->description=$request->description;
        $task->due_date=$request->due_date;
        $task->user_id=$request->user_id;
        $task->is_completed=$request->is_completed;
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task=Task::findOrFail($id);
        return view('show',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('edit', compact('task'));
    }
    public function update(Request $request, string $id)
    {
        $task=Task::findOrFail($id);
        $request->validate([
            'description' => 'required',
            'is_completed' => 'required'
        ]);

        $task->title=$request->title;
        $task->description=$request->description;
        $task->is_completed=$request->is_completed;
        $task->due_date=$request->due_date;
        $task->user_id=$request->user_id;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        if (Auth::user()->name==='admin' || $task->is_completed) {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
        }
        return redirect()->route('tasks.index')->with('error', 'Only users who have completed their tasks can delete it.');

    }

    public function trashed()
    {
        /*  $this->authorize('trashed_task');*/

        $tasks = Task::onlyTrashed()->get();
        return view('trashed',compact('tasks'));
    }
}
