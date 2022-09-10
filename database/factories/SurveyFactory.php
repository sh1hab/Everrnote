<?php

namespace Database\Factories;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
 */
class SurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => '63118b695487ad1fb906a6c7',
            'title' => $this->faker->title,
            'description' => $this->faker->realText,
            'expire_date' => now()->format('d/m/y')
        ];
    }
}
