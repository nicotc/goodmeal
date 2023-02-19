<?php

namespace Modules\Products\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Products\Entities\Product;
use Modules\Stores\Entities\Store;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

            $store = Store::inRandomOrder()->first();
            $storeId = $store->id;

        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(250),
            'price' => $this->faker->randomFloat(0 , 1000),
            'discount' => $this->faker->randomFloat(50, 70),
            'image' => $this->faker->imageUrl(80, 100),
            'category' => $this->faker->randomElement(['Snacks', 'Lácteos y quesos', 'Congenlados']),
            'stock' => $this->faker->numberBetween(0, 10),
            'store_id' => $storeId
        ];
    }
}
