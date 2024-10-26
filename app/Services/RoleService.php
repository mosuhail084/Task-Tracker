<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleService
{
    /**
     * Retrieve all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection<Role>
     */
    public function getAllRoles(): \Illuminate\Database\Eloquent\Collection
    {
        return Role::all();
    }
    /**
     * Create a new role and sync its permissions.
     *
     * @param array $data
     * @return Role
     */

    public function createRole(array $data): Role
    {
        $permissions = isset($data['permissions']) ? $data['permissions'] : null;
        unset($data['permissions']);
        
        $role = Role::create($data);

        // Check if permissions are provided and sync them
        if ($permissions) {
            $role->syncPermissions($permissions);
        }

        return $role;
    }


    /**
     * Retrieve a role by its ID with permissions.
     *
     * @param int $id
     * @return Role
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getRoleById(int $id): Role
    {
        return Role::with('permissions')->findOrFail($id);
    }

    /**
     * Update an existing role and sync its permissions.
     *
     * @param Role $role
     * @param array $data
     * @return Role
     */
    public function updateRole(Role $role, array $data): Role
    {
        // Sync permissions if provided
        if (isset($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
            unset($data['permissions']);
        }

        $role->update($data);

        return $role;
    }

    /**
     * Delete a role by its ID.
     *
     * @param int $id
     * @return void
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deleteRole(int $id): void
    {
        // Fetch the role by ID
        $role = $this->getRoleById($id);

        // Delete the role
        $role->delete();
    }

    /**
     * Retrieve all permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection<Permission>
     */
    public function getAllPermissions(): \Illuminate\Database\Eloquent\Collection
    {
        return Permission::all(); // Fetch all permissions
    }
}
