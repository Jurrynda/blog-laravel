<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition()
    {
        $title = $this->faker->words(random_int(3, 7), true);
        return [
            'user_id' => random_int(1, 10),
            'title' => ucfirst($title),
            'slug' => str_slug($title),
            'text' => $this->faker->paragraph(random_int(1, 5)),
            'tags' => 'tag-1, tag-2, tag-3',
        ];
    }
}
