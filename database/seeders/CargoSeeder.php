<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cargos')->insert([
            ['nome' => 'Administrador', 'descricao' => 'Acesso total ao sistema'],
            ['nome' => 'Gerente', 'descricao' => 'Gestão de equipe e operações'],
            ['nome' => 'Atendente', 'descricao' => 'Atendimento ao cliente e vendas'],
            ['nome' => 'Veterinário', 'descricao' => 'Cuidados com animais e consultas'],
            ['nome' => 'Tosador', 'descricao' => 'Banho e tosa'],
            ['nome' => 'Estoquista', 'descricao' => 'Controle de estoque'],
        ]);
    }
}
