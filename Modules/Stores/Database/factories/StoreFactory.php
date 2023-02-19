<?php

namespace Modules\Stores\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Stores\Entities\Store;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'logo' => $this->faker->imageUrl(50,50),
            'header' => $this->faker->imageUrl(200,60),
            'address' => $this->faker->address(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'withdrawal_schedule' => $this->faker->randomElement(['9:00 a 21:00 hrs', '11:00 a 23:00 hrs']),
            'ratings' => $this->faker->numberBetween(0, 5),
        ];
    }
}
