<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fornecedores')->insert([
            [
                'razao_social' => 'PetFood Distribuidora LTDA',
                'nome_fantasia' => 'PetFood',
                'cnpj' => '12345678000195',
                'email' => 'vendas@petfood.com.br',
                'telefone' => '(11) 3333-4444',
                'endereco' => 'Rua das Indústrias, 100 - São Paulo/SP'
            ],
            [
                'razao_social' => 'Brinquedos Pet Brasil LTDA',
                'nome_fantasia' => 'Brinquedos Pet',
                'cnpj' => '98765432000110',
                'email' => 'contato@brinquedospet.com.br',
                'telefone' => '(11) 5555-6666',
                'endereco' => 'Av. Comercial, 200 - São Paulo/SP'
            ],
            [
                'razao_social' => 'Farmácia Veterinária São Paulo LTDA',
                'nome_fantasia' => 'FarmVet',
                'cnpj' => '45678912000144',
                'email' => 'pedidos@farmvet.com.br',
                'telefone' => '(11) 7777-8888',
                'endereco' => 'Rua dos Médicos, 300 - São Paulo/SP'
            ],
        ]);
    }
}
