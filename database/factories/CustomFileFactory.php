<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomFile>
 */
class CustomFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'      => fake()->name(),
            'path'      => fake()->filePath(),
            'mime_type' => fake()->mimeType(),
            'extension' => fake()->fileExtension(),
            'size'      => fake()->numberBetween(1, 100_000),
            'added_by'  => Str::uuid()->toString(),
        ];
    }
}
