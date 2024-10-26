<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    public const STATUS_ONGOING = 'ongoing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_PENDING = 'pending';

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'assigned_to',
        'due_date',
        'status',
    ];

    /**
     * Relationships
     */

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Scopes
     */

    // Scope for in-ongoing tasks
    public function scopeInProgress($query)
    {
        return $query->where('status', self::STATUS_ONGOING);
    }

    // Scope for completed tasks
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    // Scope for tasks assigned to a specific user
    public function scopeAssignedToUser($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    /**
     * Accessors & Mutators
     */

    // accessor to capitalize the task title
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function getDueDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
    
    // mutator to ensure due date is stored correctly
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = \Carbon\Carbon::parse($value);
    }

}
