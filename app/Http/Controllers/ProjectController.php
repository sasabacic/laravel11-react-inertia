<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $query = Project::query();
        //The request() class is reading the URL parameters that the browser sent
        $sortField = request("sort_field","created_at");
        $sortDirection = request("sort_direction","desc");

        if(request('name')) {
            $query->where("name","like","%". request("name") . "%");
        }
        if (request("status")) {
            $query->where("status",request("status"));
        }

        $projects = $query->orderBy($sortField,$sortDirection)
        ->paginate(10)->onEachSide(1);

        //Inertia is creating the Response object
        return inertia("Project/Index",[
            //we are transforming database results before sending to the frontend
            /*Collection loops through each project in the collection
            and applies ProjectResource transformation to each one */
            'projects' => ProjectResource::collection($projects),
            'queryParams' => request()->query() ?: null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $query = $project->tasks();
        $sortField = request("sort_field","created_at");
        $sortDirection = request("sort_direction","desc");

        if(request('name')) {
            $query->where("name","like","%". request("name") . "%");
        }
        if (request("status")) {
            $query->where("status",request("status"));
        }

        $tasks = $query->orderBy($sortField,$sortDirection)
        ->paginate(10);
        return inertia('Project/Show',[
            'project' => new ProjectResource($project),
            'tasks' => TaskResource::collection($tasks),
            'queryParams' => request()->query() ?: null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
