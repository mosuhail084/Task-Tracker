<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Get all users.
     *
     * @return Collection
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * Create a new user and assign the role,
     *
     * @param  array  $data
     * @return User
     */
    public function createUser(array $data)
    {
        $role = isset($data['role']) ? $data['role'] : null;
        unset($data['role']);

        $user = User::create($data);

        if ($role) {
            $user->assignRole($role);
        }

        return $user;
    }

    /**
     * Update an existing user.
     *
     * @param  User  $user
     * @param  array  $data
     * @return User
     */
    public function updateUser(User $user, array $data)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if (isset($data['role'])) {
            $user->syncRoles([$data['role']]);
            unset($data['role']);
        }

        $user->update($data);

        return $user;
    }


    /**
     * Delete a user.
     *
     * @param  User  $user
     * @return void
     */
    public function deleteUser(User $user)
    {
        $user->delete();
    }

    /**
     * Change user password.
     *
     * @param  User  $user
     * @param  string  $currentPassword
     * @param  string  $newPassword
     * @return void
     */
    public function changePassword(User $user, string $currentPassword, string $newPassword)
    {
        if (!Hash::check($currentPassword, $user->password)) {
            throw new \Exception('Current password is incorrect.');
        }
        $user->update(['password' => Hash::make($newPassword)]);
    }
}
