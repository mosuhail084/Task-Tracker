<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if the Admin role exists; create it if it doesn't
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Create an admin user
        $adminUser = User::firstOrCreate([
            'email' => 'admin@admin.com'
        ], [
            'name' => 'Admin User',
            'password' => Hash::make('12345678') // Replace 'password123' with a secure password
        ]);

        // Assign the Admin role to the user
        $adminUser->assignRole($adminRole);
    }
}
