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
        $user = User::query()->inRandomOrder()->first();
        $clinic = Clinic::where('organization_id', $user->organization_id)->inRandomOrder()->first();
        $assessor = Assessor::where('organization_id', $user->organization_id)->inRandomOrder()->first();

        $choices = [];
        $slugs = Question::pluck('slug');

        foreach ($slugs as $slug) {
            $choices[$slug] = fake()->boolean() ? 1 : 0;
        }
        return [
            'user_id' => $user->id,
            'clinic_id' => $clinic->id,
            'organization_id' => $user->organization_id,
            'assessor_id' => $assessor->id,
            'date' => fake()->date(),
            'choices' => $choices,
        ];
    }
}
