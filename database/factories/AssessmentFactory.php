<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Assessor;
use App\Models\Question;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assessment>
 */
class AssessmentFactory extends Factory
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
        $clinicId = fake()->randomElement(Clinic::where('organization_id', $organizationId)->pluck('id'));
        $assessorId = fake()->randomElement(Assessor::where('organization_id', $organizationId)->pluck('id'));

        $choices = [];
        $slugs = Question::pluck('slug');

        foreach ($slugs as $slug) {
            $choices[$slug] = fake()->boolean() ? 1 : 0;
        }
        return [
            'user_id' => $userId,
            'clinic_id' => $clinicId,
            'organization_id' => $organizationId,
            'assessor_id' => $assessorId,
            'date' => fake()->date(),
            'choices' => $choices,
        ];
    }
}
