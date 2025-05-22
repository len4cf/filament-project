<?php

namespace Database\Seeders;

use App\Enums\StatusImoveis;
use App\Enums\TipoCliente;
use App\Enums\TipoImovel;
use App\Models\Clientes;
use App\Models\Corretores;
use App\Models\Imoveis;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        Clientes::factory()->create([
//            'id' => 1,
//            'nome' => 'Cliente Padrão',
//            'email' => 'cliente@cliente.com',
//            'telefone' => '99999999',
//        ]);
//
//        Clientes::factory()->create([
//            'id' => 2,
//            'nome' => 'Helena Proprietária',
//            'email' => 'helena.proprietario@gmail.com',
//            'telefone' => '(27) 99932-5336',
//            'tipo' => 'proprietario'
//        ]);

        User::factory()->create([
            'name' => 'admin do app',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123'),
        ]);

        Clientes::factory()->create([
            'nome' => 'Helena Inquilina',
            'email' => 'helena_inquilina@gmail.com',
            'telefone' => '(27) 99932-5336',
            'tipo' => TipoCliente::Inquilino
        ]);

        $proprietario = Clientes::factory()->create([
            'nome' => 'Helena Proprietaria',
            'email' => 'helena_proprietaria@gmail.com',
            'telefone' => '(27) 99932-5336',
            'tipo' => TipoCliente::Proprietario
        ]);

        Clientes::factory()->create([
            'nome' => 'Helena Interessada',
            'email' => 'helena_interessada@gmail.com',
            'telefone' => '(27) 99932-5336',
            'tipo' => TipoCliente::Interessado
        ]);

        $corretor =Corretores::factory()->create([
            'nome' => 'Helena Corretora',
            'creci' => '12345',
            'email' => 'helena_corretora@gmail.com',
        ]);

        Imoveis::factory()->create([
            'titulo' => 'Apartamento a venda',
            'descricao' => 'Apartamento a venda',
            'tipo' => TipoImovel::APARTAMENTO,
            'endereco' => 'Rua Visconde do Rio Branco, 243',
            'bairro' => 'Mercês',
            'cidade' => 'Curitiba',
            'uf' => 'PR',
            'cep' => '80410-000',
            'area' => 120.00,
            'num_quartos' => 3,
            'num_banheiros' => 2,
            'valor' => 10.000,
            'status' => StatusImoveis::VENDA,
            'proprietario_id' => $proprietario->id,
            'corretor_id' => $corretor->id,
            'inquilino_id' => null
        ]);


    }
}
