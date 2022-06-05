<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1,4),
            'name' => $this->faker->sentence(2, true),
            'price' => $this->faker->numberBetween(20000, 60000),
            'description' => $this->faker->sentences(2, true),
            'stock' => $this->faker->numberBetween(5, 15),
            'img_url' => $this->faker->image('public/assets/img',200,200,null,false),
            'seller_id' => $this->faker->numberBetween(1,2),
        ];
    }
}
