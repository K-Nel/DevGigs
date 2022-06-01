<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(),
            'tags'=> 'Laravel, JS, PHP, HTML, API',
            'company'=>$this->faker->company(),
            'email'=>$this->faker->companyEmail(),
            'website'=>$this->faker->url(),
            'location'=>$this->faker->city(),
            'description'=>$this->faker->paragraph(10)

        ];
    }
}
