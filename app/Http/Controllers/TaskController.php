<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of tasks with optional filters.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $assignedToId = $request->input('assigned_to');
        $projectId = $request->input('project');

        $tasks = $this->taskService->getTasksByUserRole($user, $assignedToId, $projectId);

        // Fetch users and projects for filter options
        $users = User::all();
        $projects = Project::all();

        return view('tasks.index', compact('tasks', 'users', 'projects'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return View
     */
    public function create()
    {
        $data = $this->taskService->getCreateData();
        return view('tasks.create', $data);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param TaskStoreRequest $request
     * @return RedirectResponse
     */
    public function store(TaskRequest $request)
    {
        $this->taskService->createTask($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $data = $this->taskService->getTaskForEdit($id);

        return view('tasks.edit', $data);
    }

    /**
     * Update the specified task in storage.
     *
     * @param TaskRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaskRequest $request, $id)
    {
        // Validate the incoming request data via TaskRequest
        $validatedData = $request->validated();

        // Use the service to update the task
        $this->taskService->updateTask($id, $validatedData);

        // Redirect back with a success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task from storage.
     *
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
