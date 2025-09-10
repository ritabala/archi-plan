<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Traits\SuperAdminPermissions;
use App\Models\Company;

class RolePermissionsSeeder extends Seeder
{
    use SuperAdminPermissions;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        // Define roles with their display names
        $roles = [
            'super-admin' => 'Super Admin',
        ];

        foreach ($companies as $company) {
            $roles['admin-' . $company->id] = 'Admin';
            $roles['staff-' . $company->id] = 'Staff';
            $roles['member-' . $company->id] = 'Member'; 
        }
    
        // Define permissions with display names
        $permissions = [
            // Manage Roles and Permissions
            'manage_roles' => 'Manage Roles',
            'manage_permissions' => 'Manage Permissions',

            // Dashboard
            'view_dashboard' => 'View Dashboard',

            // Billing
            'manage_billing' => 'Manage Billing',
            'upgrade_plan' => 'Upgrade Plan',
            
        ];

        // Add super-admin permissions
        $companyPermissions = self::getSuperAdminPermissions();
    
        // Create permissions if they don't exist
        foreach (array_merge($permissions, $companyPermissions) as $name => $displayName) {
            Permission::firstOrCreate([
                'name' => $name,
                'display_name' => $displayName
            ]);
        }
    
        // Create roles and assign permissions
        foreach ($roles as $roleName => $displayName) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'display_name' => $displayName
            ]);
    
            // Super Admin permissions
            if ($roleName === 'super-admin') {
                // Super admin gets only gym permissions
                $role->syncPermissions(self::getSuperAdminPermissionNames());
            }

            // Grant full permissions to Admin (except super-admin permissions)
            if ($displayName === 'Admin') {
                $role->syncPermissions(array_keys($permissions));
            }
    
            // Staff gets some permissions
            if ($displayName === 'Staff') {
                $role->syncPermissions([
                    'view_dashboard',
                    'manage_billing'
                ]);
            }
    
            // Member role usually has no permissions by default
        }

        // Check and create users only if they do not already exist
        $this->createUserWithRole('super-admin@example.com', 'Super Admin', 'super-admin');

        foreach ($companies as $company) {
            $this->createUserWithRole('admin-' . $company->id . '@example.com', 'admin-' . $company->id, 'admin-' . $company->id, $company->id);
        }
    }

    /**
     * Helper function to create a user and assign a role if the user does not exist.
     */
    private function createUserWithRole($email, $name, $roleName, $companyId = null)
    {
        // Debugging output to see if the user exists before insertion
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            \Log::info("User with email {$email} already exists, skipping creation.");
        } else {
            // If user does not exist, create the user
            $user = User::create([
                'company_id' => ($roleName == 'super-admin') ? null : $companyId,
                'name' => $name,
                'email' => $email,
                'password' => bcrypt('password@123'),
                'email_verified_at' => now(),
                'is_active' => 1,
            ]);

            // Assign the role to the user
            $user->assignRole($roleName);

            // Log the user creation
            \Log::info("User with email {$email} created and assigned role {$roleName}.");
        }
    }
}
