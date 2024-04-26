<?php

namespace Database\Factories;

use App\constants\Status;
use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->sentence(),
            'price' => fake()->randomNumber(3),
            'status' => Status::DRAFT,
            'author_id' => User::factory(),
            // 'location_id' => Location::factory(),
            // 'category_id' => Category::factory()
        ];
    }
}
