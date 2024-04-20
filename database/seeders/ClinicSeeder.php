<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
	      Clinic::factory()
	        ->count(50)
	        ->create();
    }
}
