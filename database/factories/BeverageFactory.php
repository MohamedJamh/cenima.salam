<?php

namespace Database\Factories;

use App\Models\Beverage;
use App\Models\BeverageType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Beverage>
 */
class BeverageFactory extends Factory
{
    protected $model = Beverage::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $beverage_type_id = $this->faker->randomElement(BeverageType::pluck('id'));
        return [
            'title' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2,15,100),
            'beverage_type_id' => $beverage_type_id
        ];
    }
}
