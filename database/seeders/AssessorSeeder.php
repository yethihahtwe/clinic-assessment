<?php

namespace Database\Seeders;

use App\Models\Assessor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run(): void
     {
           Assessor::factory()
               ->count(50)
               ->create();
     }
}
