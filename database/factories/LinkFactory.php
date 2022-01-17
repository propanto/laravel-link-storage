<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Link::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'user_id' => User::pluck('id')->random(),
          'name' => $this->faker->name(),
          'url' => $this->faker->unique()->url(),
          'description' => $this->faker->sentence(),
        ];
    }
}
