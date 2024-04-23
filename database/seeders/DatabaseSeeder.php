<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Assessor;
use App\Models\Assessment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory()
            ->count(30)
            ->create();

        Clinic::factory()
	        ->count(50)
	        ->create();

        Assessor::factory()
           ->count(100)
           ->create();

        Assessment::factory()
            ->count(100)
            ->create();
    }
}
