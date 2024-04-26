<?php

namespace Database\Factories;

use App\Enums\Message\MessageStatus;
use App\Models\Customer;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $messageable = $this->faker->randomElement([Ticket::class, Task::class]);

        $senderable = $this->faker->randomElement([User::class, Customer::class]);

        return [
            'body'  => $this->faker->realText,
            'messageable_type' => $messageable::class,
            'messageable_id' => $messageable::factory(),
            'senderable_type' => $senderable::class,
            'senderable_id' => $senderable::factory(),
            'status' => $this->faker->randomElement(array_values(MessageStatus::cases())),
        ];
    }

    /**
     * Indicate sent status for the message.
     */
    public function sent(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => MessageStatus::SENT->value,
            ];
        });
    }

    /**
     * Indicate seen status for the message.
     */
    public function seen(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => MessageStatus::SEEN->value,
            ];
        });
    }
}
