<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $user = auth()->user();
        $projects = $this->projectService->getProjectsForUser($user);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        $managers = $this->projectService->getManagers();
        return view('projects.create', compact('managers'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(ProjectRequest $request)
    {
        $this->projectService->createProject($request->validated());
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        $managers = $this->projectService->getManagers();
        return view('projects.edit', compact('project', 'managers'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $this->projectService->updateProject($project, $request->validated());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        $this->projectService->deleteProject($project);
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
