<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectManagerNotification;
use App\Models\User;

class ProjectService
{
    /**
     * Create a new project and notify the manager.
     */
    public function createProject(array $data)
    {
        $project = Project::create($data);
        $this->notifyManager($project);
        return $project;
    }

    /**
     * Get a list of managers.
     *
     * @return Collection
     */
    public function getManagers()
    {
        return User::byRole(User::ROLE_MANAGER)->get();
    }

    /**
     * Retrieve projects based on the user's role.
     *
     * This method checks the role of the authenticated user and returns
     * the appropriate projects:
     * - If the user has an 'admin' role, all projects are returned.
     * - If the user has a 'manager' role, only projects assigned to that manager are returned.
     * - For other roles, an empty collection is returned.
     *
     * @param User $user The authenticated user instance.
     * @return Collection A collection of projects that the user has access to.
     */
    public function getProjectsForUser($user)
    {
        if ($user->hasRole('admin')) {
            return Project::all();
        } elseif ($user->hasRole('manager')) {
            return Project::byManager($user->id)->get();
        }

        return collect();
    }

    /**
     * Update an existing project and notify the manager if the manager changes.
     */
    public function updateProject(Project $project, array $data)
    {
        $previousManagerId = $project->manager_id;
        $project->update($data);

        // Notify the manager only if the manager has changed
        if ($previousManagerId !== $data['manager_id']) {
            $this->notifyManager($project, $previousManagerId);
        }

        return $project;
    }

    /**
     * Delete the specified project.
     */
    public function deleteProject(Project $project)
    {
        return $project->delete();
    }

    /**
     * Notify the current and previous project managers via email about project management changes.
     *
     * This method sends an email notification to the new project manager whenever a project's manager 
     * is updated. If there was a previous manager, they also receive a notification about the change.
     *
     * @param \App\Models\Project $project The project instance for which the manager notification is being sent.
     * @param int|null $previousManagerId The ID of the previous project manager, if applicable. If null, no notification is sent to a previous manager.
     *
     * @return void
     */
    protected function notifyManager(Project $project, $previousManagerId = null)
    {
        $currentManager = $project->manager;
        if ($currentManager) {
            Mail::to($currentManager->email)->send(
                new ProjectManagerNotification($project, $currentManager->name, false)
            );
        }

        // If there was a previous manager, send them a notification as well
        if ($previousManagerId && $previousManagerId !== $project->manager_id) {
            $previousManager = User::find($previousManagerId);
            if ($previousManager) {
                Mail::to($previousManager->email)->send(
                    new ProjectManagerNotification($project, $previousManager->name, true)
                );
            }
        }
    }
}
