<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Company;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            'Apex Design Group',
            'Canvas Creations',
            'Urban Escapes Studio',
            'Legacy Structures',
            'Vanguard Architects',
            'Horizon Design Company'
        ];

        foreach ($companies as $company) { 
            $companyName = $company;
            $companySlug = Str::slug($companyName) . '-' . Str::random(5);

            Company::create([
                'slug' => $companySlug,
                'name' => $companyName,
                'address' => fake()->address(),
                'phone' => fake()->phoneNumber(),
                'email' => fake()->email(),
                'website' => fake()->url(),
                'timezone' => 'Asia/Kolkata',
                'locale' => 'en'
            ]);
        }
    }
}
