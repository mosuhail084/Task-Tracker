<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getDashboardData(): array
    {
        $user = Auth::user();
        $data = [];

        if ($user->hasRole('admin')) {
            $data = $this->getAdminDashboardData();
        } elseif ($user->hasRole('manager')) {
            $data = $this->getManagerDashboardData($user->id);
        } else {
            $data = $this->getUserDashboardData($user->id);
        }

        return $data;
    }

    protected function getAdminDashboardData(): array
    {
        return [
            'totalProjects' => $this->taskRepository->countAllProjects(),
            'totalTasks' => $this->taskRepository->countAllTasks(),
            'tasksOngoing' => $this->taskRepository->countTasksByStatus(Task::STATUS_ONGOING),
            'completedTasks' => $this->taskRepository->countTasksByStatus(Task::STATUS_COMPLETED)
        ];
    }

    protected function getManagerDashboardData(int $managerId): array
    {
        $projectIds = Project::byManager($managerId)->pluck('id')->toArray();

        return [
            'totalProjects' => count($projectIds),
            'totalTasks' => $this->taskRepository->countManagerTasks($projectIds),
            'tasksOngoing' => $this->taskRepository->countManagerTasksByStatus($projectIds, Task::STATUS_ONGOING),
            'completedTasks' => $this->taskRepository->countManagerTasksByStatus($projectIds, Task::STATUS_COMPLETED)
        ];
    }


    protected function getUserDashboardData(int $userId): array
    {
        return [
            'totalProjects' => $this->taskRepository->countUserProjects($userId),
            'totalTasks' => $this->taskRepository->countUserTasks($userId),
            'tasksOngoing' => $this->taskRepository->countUserTasksByStatus($userId, Task::STATUS_ONGOING),
            'completedTasks' => $this->taskRepository->countUserTasksByStatus($userId, Task::STATUS_COMPLETED)
        ];
    }
}
