<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{

    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'user_id' => $this->faker->randomDigitNot(0),
            'todolist_id' => $this->faker->randomDigitNot(0),
            'priority' => $this->faker->randomDigitNot(0),
            'description' => $this->faker->sentence(),
            'deadline' => $this->faker->date(),
            'done' => $this->faker->boolean(),
        ];
    }
}
