<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'content' => fake()->paragraphs(3, true),
            'type' => fake()->randomElement(['appointment_reminder', 'maintenance_due', 'payment_reminder', 'rating_reminder', 'warranty_expiring', 'referral_earned']),
            'read_at' => fake()->dateTime(),
            'scheduled_at' => fake()->dateTime(),
            'sent_at' => fake()->dateTime(),
            'data' => '{}',
        ];
    }
}
