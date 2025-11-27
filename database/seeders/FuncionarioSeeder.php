<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar Users primeiro
        $userAdmin = User::create([
            'name' => 'Administrador do Sistema',
            'email' => 'admin@petshop.com',
            'password' => Hash::make('123456'),
        ]);

        $userGerente = User::create([
            'name' => 'Carlos Silva - Gerente',
            'email' => 'carlos.gerente@petshop.com',
            'password' => Hash::make('123456'),
        ]);
       

        // Agora criar funcionários vinculados aos users
        DB::table('funcionarios')->insert([
            [
                'nome' => 'Administrador do Sistema',
                'cpf' => '12345678901',
                'telefone' => '(11) 99999-9999',
                'cargo_id' => 1, // Administrador
                'user_id' => $userAdmin->id,
                'ativo' => true
            ],
            [
                'nome' => 'Carlos Silva',
                'cpf' => '23456789012',
                'telefone' => '(11) 88888-8888',
                'cargo_id' => 2, // Gerente
                'user_id' => $userGerente->id,
                'ativo' => true
            ],
        ]);
    }
}
