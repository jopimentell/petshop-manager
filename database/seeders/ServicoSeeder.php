<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('servicos')->insert([
            [
                'nome' => 'Banho Simples', 
                'descricao' => 'Banho com shampoo específico para o tipo de pelagem',
                'preco' => 35.00,
                'duracao_minutos' => 30
            ],
            [
                'nome' => 'Banho e Tosa', 
                'descricao' => 'Banho completo e tosa higiênica',
                'preco' => 60.00,
                'duracao_minutos' => 60
            ],
            [
                'nome' => 'Tosa Completa', 
                'descricao' => 'Tosa na máquina conforme raça e preferência do cliente',
                'preco' => 80.00,
                'duracao_minutos' => 90
            ],
            [
                'nome' => 'Consulta Veterinária', 
                'descricao' => 'Consulta de rotina com veterinário especializado',
                'preco' => 120.00,
                'duracao_minutos' => 30
            ],
            [
                'nome' => 'Vacinação', 
                'descricao' => 'Aplicação de vacinas V8, V10, antirrábica',
                'preco' => 50.00,
                'duracao_minutos' => 15
            ],
            [
                'nome' => 'Corte de Unhas', 
                'descricao' => 'Corte e lixamento de unhas',
                'preco' => 25.00,
                'duracao_minutos' => 15
            ],
            [
                'nome' => 'Limpeza de Ouvidos', 
                'descricao' => 'Limpeza e higienização dos ouvidos',
                'preco' => 20.00,
                'duracao_minutos' => 10
            ],
            [
                'nome' => 'Hospedagem Diária', 
                'descricao' => 'Hospedagem com alimentação e cuidados',
                'preco' => 80.00,
                'duracao_minutos' => 1440 // 24 horas
            ],
        ]);
    }
}
