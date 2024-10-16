<?php
// database/seeders/RoleSeeder.php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // RoleSeeder::class,
            // UserSeeder::class,
            // UltgSeeder::class,
            // GarduSeeder::class,
            // TrafoSeeder::class
            RoleSeeder::class,
            FacilitySeeder::class,
            DamageReportSeeder::class,
            RepairActivitySeeder::class
            // other seeders...
        ]);

        // User::factory(10)->create();

    }
}

