<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vacation;

class VacationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $d1 = $this->faker->date();
        $d2 = $this->faker->date();
        $d1f = strtotime($d1) < strtotime($d2);

        return [
            'from' => $d1f ? $d1 : $d2,
            'to' => $d1f ? $d2 : $d1
        ];
    }
}
