<?php

namespace Database\Factories\data;

use App\Models\data\NewsLetter;
use Illuminate\Database\Eloquent\Factories\Factory;



class NewsLetterFactory extends Factory{

    protected $model = NewsLetter::class ;

    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'export' => fake()->boolean('33'),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}
