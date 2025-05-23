<?php

namespace Database\Factories;

use App\Enums\TipoCliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clientes>
 */
class ClientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => $this->faker->phoneNumber(),
            'tipo' => $this->faker->randomElement([
                TipoCliente::Inquilino->value,
                TipoCliente::Interessado->value,
                TipoCliente::Proprietario->value,
            ]),
        ];
    }
}
