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
        $firms = Company::all();
        // Define roles with their display names
        $roles = [
            'super-admin' => 'Super Admin',
        ];

        foreach ($firms as $firm) {
            $roles['admin-' . $firm->id] = 'Admin'; 
            $roles['manager-' . $firm->id] = 'Manager'; 
            $roles['staff-' . $firm->id] = 'Staff';
            $roles['client-' . $firm->id] = 'Client';
            $roles['collaborator-' . $firm->id] = 'Collaborator';
        }
    
        // Define permissions with display names
        $permissions = [
            // Manage Roles and Permissions
            'manage_roles' => 'Manage Roles',
            'manage_permissions' => 'Manage Permissions',

            // Dashboard
            'view_dashboard' => 'View Dashboard',

            // Portfolios
            'view_portfolios' => 'View Portfolios',
            'view_portfolio_details' => 'View Portfolio Details',
            'create_portfolio' => 'Create Portfolio',
            'edit_portfolio' => 'Edit Portfolio',
            'delete_portfolio' => 'Delete Portfolio',  
            'share_with_client' => 'Share with Client',          

            // Proposals
            'view_proposal' => 'View Proposal',
            'create_proposal' => 'Create Proposal',
            'edit_proposal' => 'Edit Proposal',
            'delete_proposal' => 'Delete Proposal',
            'send_proposal_to_client' => 'Send Proposal to Client',
            'approve_proposal' => 'Approve Proposal',
            'reject_proposal' => 'Reject Proposal',
            'comment_on_proposal' => 'Comment on Proposal',
            'draft_proposal' => 'Draft Proposal',

            // Clients
            'view_clients' => 'View Clients',
            'view_client_details' => 'View Client Details',
            'create_client' => 'Create Client',
            'edit_client' => 'Edit Client',
            'delete_client' => 'Delete Client',
            'assign_proposal' => 'Assign Proposal',

            //projects
            'manage_projects' => 'Manage Projects',
            'view_projects' => 'View Projects',
            'view_projects_details' => 'View Projects Details',
            'create_projects' => 'Create Projects',
            'edit_projects' => 'Edit Projects',
            'delete_projects' => 'Delete Projects',

            //tasks
            'manage_tasks' => 'Manage Tasks',
            'view_tasks' => 'View Tasks',
            'view_tasks_details' => 'View Tasks Details',
            'create_tasks' => 'Create Tasks',
            'edit_tasks' => 'Edit Tasks',
            'delete_tasks' => 'Delete Tasks',

            //messages
            'manage_messages' => 'Manage Messages',
            'view_messages' => 'View Messages',
            'view_messages_details' => 'View Messages Details',

            //invoices
            'view_invoices' => 'View Invoices',
            'view_invoice_details' => 'View Invoice Details',
            'create_invoices' => 'Create Invoices',
            'edit_invoices' => 'Edit Invoices',
            'delete_invoices' => 'Delete Invoices',
            'send_invoice_to_client' => 'Send Invoice to Client',
            'pay_invoice' => 'Pay Invoice',
            'refund_invoice' => 'Refund Invoice',

            //payments
            'manage_payments' => 'Manage Payments',
            'view_payments' => 'View Payments',
            'view_payments_details' => 'View Payments Details',
            'create_payments' => 'Create Payments',
            'edit_payments' => 'Edit Payments',
            'delete_payments' => 'Delete Payments',

            //estimates
            'manage_estimates' => 'Manage Estimates',
            'view_estimates' => 'View Estimates',
            'view_estimates_details' => 'View Estimates Details',
            'create_estimates' => 'Create Estimates',
            'edit_estimates' => 'Edit Estimates',
            'delete_estimates' => 'Delete Estimates',

            //contracts
            'manage_contracts' => 'Manage Contracts',
            'view_contracts' => 'View Contracts',
            'view_contracts_details' => 'View Contracts Details',
            'create_contracts' => 'Create Contracts',
            'edit_contracts' => 'Edit Contracts',
            'delete_contracts' => 'Delete Contracts',

            // Billing
            'manage_billing' => 'Manage Billing',
            'manage_branding' => 'Manage Branding',
            'manage_integrations' => 'Manage Integrations',
            'manage_plan' => 'Manage Plan',
            'upgrade_plan' => 'Upgrade Plan',
            
        ];

        // Add super-admin permissions
        $firmPermissions = self::getSuperAdminPermissions();
    
        // Create permissions if they don't exist
        foreach (array_merge($permissions, $firmPermissions) as $name => $displayName) {
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

            // Grant permissions to Manager
            if ($displayName === 'Manager') {
                $role->syncPermissions([
                    // Manage Roles and Permissions
                    'manage_roles',
                    'manage_permissions',

                    // Dashboard
                    'view_dashboard',

                    // Portfolios  (assigned to manager)
                    'view_portfolios', 
                    'view_portfolio_details', 
                    'create_portfolio', 
                    'edit_portfolio', 
                    'delete_portfolio', 
                    'share_with_client', 

                    // Proposals  (assigned to manager)
                    'view_proposal', 
                    'create_proposal', 
                    'edit_proposal', 
                    'delete_proposal', 
                    'send_proposal_to_client', 
                    'approve_proposal', 
                    'reject_proposal', 
                    'comment_on_proposal', 
                    'draft_proposal',
                    
                    // Clients  (assigned to manager)
                    'view_clients',   
                    'view_client_details', 
                    'create_client', 
                    'edit_client', 
                    'delete_client', 
                    'assign_proposal', 

                    // Projects  (assigned to manager)
                    'manage_projects', 
                    'view_projects', 
                    'view_projects_details', 
                    'create_projects', 
                    'edit_projects', 
                    'delete_projects', 

                    // Tasks  (assigned to manager)
                    'manage_tasks', 
                    'view_tasks', 
                    'view_tasks_details', 
                    'create_tasks', 
                    'edit_tasks', 
                    'delete_tasks', 

                    // Messages
                    'manage_messages',
                    'view_messages',
                    'view_messages_details',

                    // Invoices  (assigned to manager)
                    'view_invoices', 
                    'view_invoice_details', 
                    'create_invoices', 
                    'edit_invoices', 
                    'delete_invoices', 
                    'send_invoice_to_client', 
                    'pay_invoice', 
                    'refund_invoice', 

                    // Payments  (assigned to manager)
                    'manage_payments', 
                    'view_payments', 
                    'view_payments_details', 
                    'create_payments', 
                    'edit_payments', 
                    'delete_payments',

                    // Estimates  (assigned to manager)
                    'manage_estimates', 
                    'view_estimates', 
                    'view_estimates_details', 
                    'create_estimates', 
                    'edit_estimates', 
                    'delete_estimates', 

                    // Contracts (assigned to manager)
                    'manage_contracts',  
                    'view_contracts', 
                    'view_contracts_details', 
                    'create_contracts', 
                    'edit_contracts', 
                    'delete_contracts', 

                ]);
            }
    
            // Staff gets some permissions
            if ($displayName === 'Staff') {
                $role->syncPermissions([
                    // Dashboard
                    'view_dashboard',

                    // Portfolios
                    'view_portfolios',
                    'view_portfolio_details',
                    'share_with_client',          

                    // Proposals
                    'view_proposal',
                    'send_proposal_to_client',
                    'comment_on_proposal',
                    'draft_proposal',

                    // Projects
                    'view_projects', // assigned to staff
                    'view_projects_details', // assigned to staff

                    // Tasks
                    'manage_tasks',
                    'view_tasks', // assigned to staff
                    'view_tasks_details', // assigned to staff
                    'create_tasks',
                    'edit_tasks',
                    'delete_tasks',

                    // Messages
                    'manage_messages',
                    'view_messages', // assigned to staff
                    'view_messages_details', // assigned to staff

                ]);
            }
    
            // Grant permissions to Client
            if ($displayName === 'Client') {
                $role->syncPermissions([
                    // Dashboard
                    'view_dashboard',

                    // Portfolios  (shared with client)
                    'view_portfolios', 
                    'view_portfolio_details', 

                    // Proposals  (own proposals)
                    'view_proposal', 
                    'approve_proposal', 
                    'reject_proposal', 
                    'comment_on_proposal', 

                    // Messages (own messages)
                    'manage_messages',
                    'view_messages',
                    'view_messages_details',

                    // Invoices  (own invoices)
                    'view_invoices', 
                    'view_invoice_details', 
                    'pay_invoice', 

                    // Payments  (own payments)
                    'view_payments', 

                    // Estimates  (own estimates)
                    'view_estimates', 

                    // Contracts (own contracts)
                    'view_contracts', 

                ]);
            }

            // Grant permissions to Collaborator
            if ($displayName === 'Collaborator') {
                $role->syncPermissions([
                    // Dashboard
                    'view_dashboard',

                    // Portfolios
                    'view_portfolios',
                    'view_portfolio_details',        
                    
                    // Projects
                    'view_projects', // assigned to collaborator
                    'view_projects_details', // assigned to collaborator

                    // Tasks
                    'manage_tasks',
                    'view_tasks', // assigned to collaborator
                    'view_tasks_details', // assigned to collaborator
                    'create_tasks',
                    'edit_tasks',
                    'delete_tasks',

                    // Messages
                    'manage_messages',
                    'view_messages', // assigned to collaborator
                    'view_messages_details', // assigned to collaborator

                ]);
            }
        }

        // Check and create users only if they do not already exist
        $this->createUserWithRole('super-admin@example.com', 'Super Admin', 'super-admin');

        foreach ($firms as $firm) {
            $this->createUserWithRole('admin-' . $firm->id . '@example.com', 'admin-' . $firm->id, 'admin-' . $firm->id, $firm->id);
            $this->createUserWithRole('manager-' . $firm->id . '@example.com', 'manager-' . $firm->id, 'manager-' . $firm->id, $firm->id);
            $this->createUserWithRole('staff-' . $firm->id . '@example.com', 'staff-' . $firm->id, 'staff-' . $firm->id, $firm->id);
            $this->createUserWithRole('client-' . $firm->id . '@example.com', 'client-' . $firm->id, 'client-' . $firm->id, $firm->id);
            $this->createUserWithRole('collaborator-' . $firm->id . '@example.com', 'collaborator-' . $firm->id, 'collaborator-' . $firm->id, $firm->id);
        }
    }

    /**
     * Helper function to create a user and assign a role if the user does not exist.
     */
    private function createUserWithRole($email, $name, $roleName, $firmId = null)
    {
        // Debugging output to see if the user exists before insertion
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            \Log::info("User with email {$email} already exists, skipping creation.");
        } else {
            // If user does not exist, create the user
            $user = User::create([
                'firm_id' => ($roleName == 'super-admin') ? null : $firmId,
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
