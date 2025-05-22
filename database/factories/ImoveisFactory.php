<?php

namespace Database\Factories;

use App\Enums\StatusImoveis;
use App\Enums\TipoImovel;
use App\Models\Imoveis;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImoveisFactory extends Factory
{
    protected $model = Imoveis::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'descricao' => $this->faker->paragraph(),
            'tipo' => $this->faker->randomElement([
                TipoImovel::CASA->value,
                TipoImovel::TERRENO->value,
                TipoImovel::APARTAMENTO->value,
                TipoImovel::COMERCIAL->value,
                TipoImovel::OUTRO->value,
            ]),
            'endereco' => $this->faker->streetAddress(),
            'bairro' => $this->faker->citySuffix(),
            'cidade' => $this->faker->city(),
            'uf' => $this->faker->stateAbbr(),
            'cep' => $this->faker->postcode(),
            'area' => $this->faker->randomFloat(2, 30, 500),
            'num_quartos' => $this->faker->numberBetween(1, 6),
            'num_banheiros' => $this->faker->numberBetween(1, 4),
            'valor' => $this->faker->randomFloat(2, 50000, 2000000),
            'status' => $this->faker->randomElement([
                StatusImoveis::VENDA->value,
                StatusImoveis::ALUGUEL->value,
                StatusImoveis::VENDIDO->value,
            ]),
            'cliente_id' => 1,
            'corretor_id' => 1,
            'inquilino_id' => 2,
        ];
    }
}
