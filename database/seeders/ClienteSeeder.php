<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserir clientes
        DB::table('clientes')->insert([
            [
                'nome' => 'João da Silva',
                'cpf' => '11122233344',
                'telefone' => '(11) 1111-1111',
                'email' => 'joao.silva@email.com',
                'endereco' => 'Rua das Flores, 123 - São Paulo/SP'
            ],
            [
                'nome' => 'Maria Oliveira',
                'cpf' => '22233344455',
                'telefone' => '(11) 2222-2222',
                'email' => 'maria.oliveira@email.com',
                'endereco' => 'Av. Paulista, 456 - São Paulo/SP'
            ],
            [
                'nome' => 'Pedro Santos',
                'cpf' => '33344455566',
                'telefone' => '(11) 3333-3333',
                'email' => 'pedro.santos@email.com',
                'endereco' => 'Rua Augusta, 789 - São Paulo/SP'
            ],
        ]);

        // Inserir animais
        DB::table('animais')->insert([
            [
                'nome' => 'Rex',
                'data_nascimento' => '2020-05-15',
                'sexo' => 'M',
                'cor' => 'Caramelo',
                'observacoes' => 'Animal muito brincalhão',
                'dono_id' => 1, // João da Silva
                'raca_id' => 5, // Vira-lata
            ],
            [
                'nome' => 'Luna',
                'data_nascimento' => '2021-03-20',
                'sexo' => 'F',
                'cor' => 'Branca e preta',
                'observacoes' => 'Gata muito tranquila',
                'dono_id' => 2, // Maria Oliveira
                'raca_id' => 9, // SRD (Gato)
            ],
            [
                'nome' => 'Thor',
                'data_nascimento' => '2019-11-10',
                'sexo' => 'M',
                'cor' => 'Dourado',
                'observacoes' => 'Adora brincar na água',
                'dono_id' => 3, // Pedro Santos
                'raca_id' => 2, // Golden Retriever
            ],
        ]);
    }
}
