<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $tasks = Auth::user()->tasks;

        $this->authorize('viewAny', Task::class);

        return response()->json([
            'message' => 'Liste des tâches de l\'utilisateur',
            'tasks' => $tasks
        ], 200);
    }

    public function create()
    {
    }

    public function store(StoreTaskRequest $request)
    {
        $request->validated();

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'message' => 'Task Created',
            'task' => $task
        ], 201);
    }

    public function show($id)
    {
        $task = Task::find($id);
        
        $this->authorize('view', $task);
        return response()->json([
            'message' => 'Task Detail',
            'task' => $task
        ], 200);
    }

    public function edit(Task $task)
    {
        $task = Task::find($task->id);
        return response()->json([
            'message' => 'Task Detail',
            'task' => $task
        ], 200);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $request->validated();

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Task Updated',
            'task' => $task
        ], 200);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return response()->json([
            'message' => 'Task Deleted'
        ], 200);
    }
}
