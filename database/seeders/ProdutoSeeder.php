<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produtos')->insert([
            // Rações
            [
                'nome' => 'Ração Premium para Cães Adultos',
                'descricao' => 'Ração super premium para cães adultos de todas as raças',
                'preco_custo' => 80.00,
                'preco_venda' => 120.00,
                'quantidade_estoque' => 50,
                'estoque_minimo' => 10,
                'categoria_id' => 1, // Ração
                'fornecedor_id' => 1, // PetFood
                'ativo' => true
            ],
            [
                'nome' => 'Ração para Gatos Castrados',
                'descricao' => 'Ração especial para gatos castrados, controle de peso',
                'preco_custo' => 60.00,
                'preco_venda' => 95.00,
                'quantidade_estoque' => 30,
                'estoque_minimo' => 8,
                'categoria_id' => 1, // Ração
                'fornecedor_id' => 1, // PetFood
                'ativo' => true
            ],
            // Brinquedos
            [
                'nome' => 'Bolinha de Borracha',
                'descricao' => 'Bolinha resistente para cães de todos os portes',
                'preco_custo' => 5.00,
                'preco_venda' => 15.00,
                'quantidade_estoque' => 100,
                'estoque_minimo' => 20,
                'categoria_id' => 2, // Brinquedos
                'fornecedor_id' => 2, // Brinquedos Pet
                'ativo' => true
            ],
            [
                'nome' => 'Arranhador para Gatos',
                'descricao' => 'Arranhador vertical com sisal e plataforma',
                'preco_custo' => 45.00,
                'preco_venda' => 75.00,
                'quantidade_estoque' => 15,
                'estoque_minimo' => 5,
                'categoria_id' => 2, // Brinquedos
                'fornecedor_id' => 2, // Brinquedos Pet
                'ativo' => true
            ],
            // Medicamentos
            [
                'nome' => 'Vermífugo para Cães e Gatos',
                'descricao' => 'Vermífugo de amplo espectro, comprimido palatável',
                'preco_custo' => 8.00,
                'preco_venda' => 18.00,
                'quantidade_estoque' => 80,
                'estoque_minimo' => 15,
                'categoria_id' => 3, // Medicamentos
                'fornecedor_id' => 3, // FarmVet
                'ativo' => true
            ],
            // Acessórios
            [
                'nome' => 'Coleira de Nylon com Guia',
                'descricao' => 'Coleira ajustável com guia de 1,5m, diversas cores',
                'preco_custo' => 12.00,
                'preco_venda' => 25.00,
                'quantidade_estoque' => 40,
                'estoque_minimo' => 10,
                'categoria_id' => 5, // Acessórios
                'fornecedor_id' => 2, // Brinquedos Pet
                'ativo' => true
            ],
        ]);
    }
}
