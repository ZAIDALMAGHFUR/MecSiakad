<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(100),
            'menu' => 'Menu ' . $this->faker->numberBetween(1000, 2000),
            'group_menu' => $this->faker->randomElement(['Menu 1', 'Menu 2', 'Menu 3', null]),
            'description' => $this->faker->realText(),
            'thumbnail' => 'thumbnails/default.jpg',
            'body' => $this->faker->realText(500)
        ];
    }
}
