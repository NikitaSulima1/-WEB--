<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(
            Project::with('tasks')->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'user_id' => 'required|exists:users,id'
        ]);

        $project = Project::create($data);

        return response()->json($project, 201);
    }
}
