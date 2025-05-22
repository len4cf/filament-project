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
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imovel_id')->constrained('imoveis');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('corretor_id')->constrained('corretores');
            $table->timestamp('data_hora');
            $table->enum('status', ['agendada', 'realizada', 'cancelada']);
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
