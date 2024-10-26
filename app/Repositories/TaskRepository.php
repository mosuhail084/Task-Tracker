<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Task;

class TaskRepository
{
    public function countAllProjects(): int
    {
        return Project::count();
    }

    public function countAllTasks(): int
    {
        return Task::count();
    }

    public function countTasksByStatus(string $status): int
    {
        return Task::where('status', $status)->count();
    }

    public function countManagerProjects(int $managerId): int
    {
        return Project::where('manager_id', $managerId)->count();
    }

    public function countManagerTasks(array $projectIds): int
    {
        return Task::whereIn('project_id', $projectIds)->count();
    }

    public function countManagerTasksByStatus(array $projectIds, string $status): int
    {
        return Task::whereIn('project_id', $projectIds)->where('status', $status)->count();
    }

    public function countUserTasks(int $userId): int
    {
        return Task::where('assigned_to', $userId)->count();
    }

    public function countUserTasksByStatus(int $userId, string $status): int
    {
        return Task::where('assigned_to', $userId)->where('status', $status)->count();
    }

    public function countUserProjects(int $userId): int
    {
        return Task::where('assigned_to', $userId)->distinct('project_id')->count();
    }
}