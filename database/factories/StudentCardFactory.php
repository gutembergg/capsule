<?php

namespace Database\Factories;

use App\Enums\SchoolEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentCard>
 */
class StudentCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school' => $this->faker->randomElement(SchoolEnum::cases()),
            'description' => $this->faker->text(),
            'is_internal' => $this->faker->boolean(),
            'user_id' => User::factory(),
            'date_of_birth' => $this->faker->dateTimeBetween('-50 years', '-12 years')
                ->format('y-m-d')
        ];
    }
}
