<?php

namespace Database\Factories;

use App\Models\Celeb;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CelebFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Celeb::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'date_of_birth' => $this->faker->date(),
            'photo' => $this->faker->imageUrl(600, 700, "person", true),
        ];
    }
}
