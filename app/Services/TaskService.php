<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TaskRequest;
use App\Mail\TaskAssignedNotification;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class TaskService
{
    /**
     * Create a new task and notify the assigned user.
     *
     * @param array $data
     * @return Task
     */
    public function createTask(array $data)
    {
        $task = Task::create($data);
        if (isset($data['assigned_to'])) {
            $user = User::find($data['assigned_to']);
            if ($user) {
                Mail::to($user->email)->send(new TaskAssignedNotification($task));
            }
        }

        return $task;
    }


    /**
     * Get all projects and users for task creation.
     *
     * @return array
     */
    public function getCreateData()
    {
        $user = Auth::user();

        if ($user->isManager()) {
            $projects = $user->managedProjects()->select('id', 'name')->get();
        } else {
            $projects = Project::select('id', 'name')->get();
        }
        $users = User::select('id', 'name')->byRole(Role::ROLE_USER)->get();

        return compact('projects', 'users');
    }

    /**
     * Retrieve the task by ID along with related projects and users.
     *
     * @param int $id
     * @return array
     * @throws ModelNotFoundException
     */
    public function getTaskForEdit($id)
    {
        $task = Task::findOrFail($id);
        $user = Auth::user();

        if ($user->isManager()) {
            $projects = $user->managedProjects()->select('id', 'name')->get();
        } else {
            $projects = Project::select('id', 'name')->get();
        }
        $users = User::select('id', 'name')->get();

        return compact('task', 'projects', 'users');
    }

    /**
     * Update the specified task.
     *
     * @param int $id
     * @param array $data
     * @return Task
     * @throws ModelNotFoundException
     */
    public function updateTask($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);

        return $task;
    }

    /**
     * Delete a task.
     *
     * @param Task $task
     * @return bool
     */
    public function deleteTask(Task $task)
    {
        return $task->delete();
    }

    /**
     * Fetch tasks based on user role and optional filters.
     *
     * @param \App\Models\User $user
     * @param int|null $assignedToId
     * @param int|null $projectId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTasksByUserRole($user, $assignedToId = null, $projectId = null)
    {
        $query = $this->getBaseTaskQuery();

        // Apply role-based constraints
        $this->applyRoleConstraints($query, $user);

        // Apply additional filters if provided
        $this->applyFilters($query, $assignedToId, $projectId);

        return $query->get();
    }

    /**
     * Start a base query for tasks with necessary relationships.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getBaseTaskQuery()
    {
        return Task::with(['assignedTo:id,name', 'project:id,name']);
    }

    /**
     * Apply role-based constraints to the task query.
     *
     * Admins see all tasks, managers see tasks for their managed projects, 
     * and regular users see only tasks assigned to them.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Models\User $user
     */
    protected function applyRoleConstraints($query, $user)
    {
        if ($user->isAdmin()) {
            return;
        }

        if ($user->isManager()) {
            $projectIds = $user->managedProjects()->pluck('id')->toArray();
            $query->whereIn('project_id', $projectIds);
        }

        if ($user->isUser()) {
            $query->where('assigned_to', $user->id);
        }
    }

    /**
     * Apply additional filters for assigned user ID and project ID.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int|null $assignedToId
     * @param int|null $projectId
     * @return void
     */
    protected function applyFilters($query, $assignedToId = null, $projectId = null)
    {
        if ($assignedToId) {
            $query->where('assigned_to', $assignedToId);
        }

        if ($projectId) {
            $query->where('project_id', $projectId);
        }
    }
}
