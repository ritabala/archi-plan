<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([            
            //Global seeders irrespective of the environment     
            CompanySeeder::class,
            RolePermissionsSeeder::class,
        ]);

        if (app()->environment('local') || app()->environment('demo')) {
            $this->call([
                CompanySeeder::class,
                RolePermissionsSeeder::class,
            ]);
        }
    }
}
