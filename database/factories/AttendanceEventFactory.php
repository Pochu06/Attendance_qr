<?php

namespace Database\Factories;

use App\Models\AttendanceEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AttendanceEvent>
 */
class AttendanceEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<AttendanceEvent>
     */
    protected $model = AttendanceEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(),
            'is_active' => false,
            'starts_at' => now(),
            'ends_at' => now()->addHours(8),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }
}