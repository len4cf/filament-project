<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('imoveis', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->string('tipo');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
            $table->string('cep');
            $table->float('area');
            $table->integer('num_quartos');
            $table->integer('num_banheiros');
            $table->decimal('valor', 10, 2);
            $table->string('status');
            $table->foreignId('proprietario_id')->constrained('clientes');
            $table->foreignId('corretor_id')->constrained('corretores');
            $table->foreignId('inquilino_id')->nullable()->constrained('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imoveis');
    }
};
