<?php

namespace Database\Factories;

use App\Enums\Bug\BugType;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bug>
 */
class BugFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $creator = $this->faker->randomElement([User::class, Customer::class]);

        return [
            'title' => $this->faker->title,
            'description' => $this->faker->realText,
            'creator_type' => $creator::class,
            'creator_id' => $creator::factory(),
            'status' => $this->faker->randomElement(array_values(BugType::cases()))
        ];
    }

    /**
     * Indicate that the bug is fixed.
     */
    public function fixed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => BugType::FIXED->value,
            ];
        });
    }

    /**
     * Indicate that the bug is in pending situation.
     */
    public function pending(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => BugType::PENDING->value,
            ];
        });
    }
}
