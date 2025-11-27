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
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_hora');
            $table->enum('situacao', ['agendado', 'confirmado', 'em_andamento', 'concluido', 'cancelado', 'nao_compareceu'])->default('agendado');
            $table->text('observacoes')->nullable();
            $table->decimal('valor_total', 10, 2)->default(0);
            $table->foreignId('animal_id')->constrained('animais');
            $table->foreignId('user_id')->constrained(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
