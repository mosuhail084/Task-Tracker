<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'manager_id',
        'status',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_ONGOING = 'ongoing';
    const STATUS_COMPLETED = 'completed';

    /**
     * Relationships
     */

    // Relationship to access all tasks under the project
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Relationship to access the user managing this project
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Scopes
     */

    // Scope to retrieve projects by a specific manager
    public function scopeByManager($query, $managerId)
    {
        return $query->where('manager_id', $managerId);
    }

    // Scope to get only active projects
    public function scopeActive($query)
    {
        return $query->whereDate('end_date', '>=', now());
    }

    // Scope to filter projects by status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Accessors & Mutators
     */

    // Accessor to format start date
    public function getFormattedStartDateAttribute()
    {
        return \Carbon\Carbon::parse($this->start_date)->format('M d, Y');
    }

    // Accessor to format end date
    public function getFormattedEndDateAttribute()
    {
        return \Carbon\Carbon::parse($this->end_date)->format('M d, Y');
    }

    // Mutator to set the project status
    public function setStatusAttribute($value)
    {
        // Ensure the status is a valid enum value
        if (!in_array($value, $this->getValidStatuses())) {
            throw new \InvalidArgumentException("Invalid status value");
        }
        $this->attributes['status'] = $value;
    }

    // Method to get valid statuses
    public function getValidStatuses()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_ONGOING,
            self::STATUS_COMPLETED,
        ];
    }
}
