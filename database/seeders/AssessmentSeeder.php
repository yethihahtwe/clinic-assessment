<?php

namespace Database\Seeders;

use App\Models\Assessment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run(): void
     {
         Assessment::factory()
             ->count(100)
             ->create();
     }
}
