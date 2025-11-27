<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nome' => 'Ração', 'descricao' => 'Alimentos para animais'],
            ['nome' => 'Brinquedos', 'descricao' => 'Brinquedos e entretenimento'],
            ['nome' => 'Medicamentos', 'descricao' => 'Remédios e suplementos'],
            ['nome' => 'Higiene', 'descricao' => 'Produtos de limpeza e cuidado'],
            ['nome' => 'Acessórios', 'descricao' => 'Coleiras, guias, camas'],
            ['nome' => 'Petiscos', 'descricao' => 'Guloseimas e snacks'],
        ]);
    }
}
