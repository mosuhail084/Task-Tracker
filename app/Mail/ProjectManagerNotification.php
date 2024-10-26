<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectManagerNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $project;
    protected $managerName;
    protected $isPreviousManager;

    /**
     * Create a new message instance.
     *
     * @param Project $project
     * @param string $managerName
     * @param bool $isPreviousManager
     */
    public function __construct(Project $project, $managerName, $isPreviousManager = false)
    {
        $this->project = $project;
        $this->managerName = $managerName;
        $this->isPreviousManager = $isPreviousManager;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->isPreviousManager 
            ? 'Project Manager Update Notification' 
            : 'New Project Assignment';

        return $this->subject($subject)
                    ->view('emails.project_manager_notification')
                    ->with([
                        'project' => $this->project,
                        'managerName' => $this->managerName,
                        'isPreviousManager' => $this->isPreviousManager,
                    ]);
    }
}