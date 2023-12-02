<?php

namespace Database\Factories;

use App\Models\ActivationCompanyUser;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivationCompanyUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActivationCompanyUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idUser'      => User::inRandomOrder()->first()->id,
            'idEstado'    => $this->faker->randomElement([1]),
            'idCompany'   => Company::inRandomOrder()->first()->id,
            'fechaInicio' => $this->faker->date,
            'fechaFin'    => $this->faker->randomElement(['2100-12-12']),
        ];
    }
}
