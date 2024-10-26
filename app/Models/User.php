<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, Notifiable, SoftDeletes;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    /**
     * Relationships
     */

    // Relationship for projects managed by the user
    public function managedProjects()
    {
        return $this->hasMany(Project::class, 'manager_id');
    }

    // Relationship for tasks assigned to the user
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    /**
     * Accessors and Mutators
     */

    // Mutator for password encryption
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Scopes
     */

    // Scope to get users by a specific role
    public function scopeByRole($query, $role)
    {
        return $query->role($role);
    }

    /**
     * Check if the user has a specific role without hardcoded values
     */
    public function isAdmin()
    {
        return $this->hasRole(Role::ROLE_ADMIN);
    }

    public function isManager()
    {
        return $this->hasRole(Role::ROLE_MANAGER);
    }

    public function isUser()
    {
        return $this->hasRole(Role::ROLE_USER);
    }
}
