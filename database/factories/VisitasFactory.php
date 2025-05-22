<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitas>
 */
class VisitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'imovel_id' => $this->faker->numberBetween(1, 10),
            'cliente_id' => $this->faker->numberBetween(1, 10),
            'corretor_id' => $this->faker->numberBetween(1, 10),
            'data_hora' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(['agendada', 'realizada', 'cancelada']),
            'observacoes' => $this->faker->optional()->paragraph(),
        ];
    }
}
