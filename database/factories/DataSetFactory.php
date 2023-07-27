<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DataSetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'       => intval($this->faker->randomFloat(0 ,1, 5)),
            'question_id'       => intval($this->faker->randomFloat(0, 1, 30)),
            'user_id'           => intval($this->faker->randomFloat(0, 1, 30)),
            'user_answer'       => $this->faker->randomFloat(0, 1, 30), 
            'correct_answer'    => $this->faker->randomFloat(0, 1, 30),
            'output'            => intval($this->faker->randomFloat(0, 0, 1))
        ];
    }
}
