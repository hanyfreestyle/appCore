<?php

namespace Database\Factories\data;

use App\Models\data\ContactUsForm;
use Illuminate\Database\Eloquent\Factories\Factory;


class ContactUsFormFactory extends Factory{

    protected $model = ContactUsForm::class;

    public function definition(): array
    {
        return [
            'name' => fake('ar_EG')->name,
            'phone' => fake()->unique()->e164PhoneNumber(),
            'full_number' => fake()->unique()->e164PhoneNumber(),
            'subject' =>  fake()->numerify('##########') ,
            'country' => fake()->randomElement(['eg', 'sa']),
            'export' => fake()->boolean('33'),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}
