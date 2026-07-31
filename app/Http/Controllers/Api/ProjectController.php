<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show(string $id)
    {
        $project = Project::with(['type', 'technologies', 'translations'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'results' => new ProjectResource($project)
        ]);
    }
}