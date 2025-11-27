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
        Schema::create('animais', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->date('data_nascimento')->nullable();
            $table->enum('sexo', ['M', 'F']);
            $table->string('cor', 50)->nullable();
            $table->text('observacoes')->nullable();
            $table->foreignId('dono_id')->constrained('clientes');
            $table->foreignId('raca_id')->constrained('racas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animais');
    }
};
