<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'first_name' => $this->faker->firstNameMale,
            'last_name' => $this->faker->lastName,
            'country_code' => $this->faker->countryCode,
            'phone_number' => $this->faker->randomNumber(7, true),
            'profile_picture' => "https://i.pravatar.cc/300?u=". $this->faker->unique()->safeEmail(),
        ];
    }
}
