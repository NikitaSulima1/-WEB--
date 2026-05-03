<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Task::with(['project','comments','author','assignedTo'])->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'nullable',
            'project_id' => 'required|exists:projects,id',
            'author_id' => 'required|exists:users,id',
            'assigned_to' => 'nullable|exists:users,id',
            'due_date' => 'nullable|date'
        ]);

        $task = Task::create($data);

        return response()->json($task, 201);
    }

    public function show($id)
    {
        return response()->json(Task::with(['project','comments'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update($request->all());

        return response()->json($task);
    }

    public function destroy($id)
    {
        Task::destroy($id);

        return response()->json(['message' => 'Deleted']);
    }
}
