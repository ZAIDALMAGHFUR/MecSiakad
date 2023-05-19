<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berita>
 */
class BeritaFactory extends Factory
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
            'category' => $this->faker->randomElement(['berita', 'pemberitahuan', 'pendaftaran', 'dll']),
            'tags' => $this->faker->randomElements(['news', 'ti', 'si', 'terbaru', 'penting', 'berita', 'pendaftaran', 'pmb', 'krs', 'khs'], rand(1, 4)),
            'description' => $this->faker->realText(),
            'thumbnail' => 'thumbnails/default.jpg',
            'tanggal_publish' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'body' => $this->faker->realText(500)
        ];
    }
}
