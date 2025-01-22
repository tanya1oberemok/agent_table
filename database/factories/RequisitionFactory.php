<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requisition>
 */
class RequisitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::query()->pluck('id')->all();
        $statuses = Status::query()->pluck('id')->all();
        $categories = Category::query()->pluck('id')->all();

        return [
            'user_id' => fake()->randomElement($users),
            'status_id' => fake()->randomElement($statuses),
            'category_id' => fake()->randomElement($categories),
            'decision_date' => Carbon::today()->subDays(rand(0, 365)),
            'description' => fake()->sentence,
        ];
    }
}
