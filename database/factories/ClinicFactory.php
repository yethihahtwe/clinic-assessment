<?php

namespace Database\Factories;

use App\Models\State;
use App\Models\Township;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinic>
 */
class ClinicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stateId = fake()->randomElement(State::pluck('id'));
        $townshipId = fake()->randomElement(Township::where('state_id', $stateId)->pluck('id'));
        $organizationId = fake()->randomElement(Organization::pluck('id'));
        return [
            'name' => fake()->company(),
            'township_id' => $townshipId,
            'state_id' => $stateId,
            'organization_id' => $organizationId,
        ];
    }
}
