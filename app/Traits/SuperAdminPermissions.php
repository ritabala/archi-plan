<?php

namespace App\Traits;

trait SuperAdminPermissions
{
    /**
     * Get all super-admin specific permissions with their display names
     *
     * @return array
     */
    public static function getSuperAdminPermissions(): array
    {
        return [
            // Company Management
            'view_companies' => 'View Companies',
            'edit_company' => 'Edit Company',
            'delete_company' => 'Delete Company',
            'add_company' => 'Add Company',
            'impersonate_admin' => 'Impersonate Admin',
            'view_all_company_payments' => 'View All Company Payments',
            
            // Package Management
            'assign_package' => 'Assign Package',
            'view_packages' => 'View Packages',
            'edit_package' => 'Edit Package',
            'delete_package' => 'Delete Package',
            'add_package' => 'Add Package',
        ];
    }

    /**
     * Get only the permission names (without display names)
     *
     * @return array
     */
    public static function getSuperAdminPermissionNames(): array
    {
        return array_keys(self::getSuperAdminPermissions());
    }

    /**
     * Check if a permission is super-admin specific
     *
     * @param string $permission
     * @return bool
     */
    public static function isSuperAdminPermission(string $permission): bool
    {
        return in_array($permission, self::getSuperAdminPermissionNames());
    }
} 