<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jurnal>
 */
class JurnalFactory extends Factory
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
            'body' => $this->faker->realText(500),
            'tanggal_publish' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
