<?php

namespace Database\Factories;

use App\Models\Schema;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theater>
 */
class TheaterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $schemas_id = Schema::pluck('id');

        return [
            "name" => $this->faker->company(),
            "schema_id" => $this->faker->randomElement($schemas_id),
        ];
    }
}
