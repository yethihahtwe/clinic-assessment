<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assessor>
 */
class AssessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $organizationId = fake()->randomElement(Organization::pluck('id'));
        $userId = fake()->randomElement(User::where('organization_id', $organizationId)->pluck('id'));
        return [
            'name' => fake()->name(),
            'position' => fake()->jobTitle(),
            'user_id' => $userId,
            'organization_id' => $organizationId,
        ];
    }
}
