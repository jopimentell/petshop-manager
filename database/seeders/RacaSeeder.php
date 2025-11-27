<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RacaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cachorros
        DB::table('racas')->insert([
            ['nome' => 'Labrador Retriever', 'especie' => 'Cachorro'],
            ['nome' => 'Golden Retriever', 'especie' => 'Cachorro'],
            ['nome' => 'Bulldog Francês', 'especie' => 'Cachorro'],
            ['nome' => 'Poodle', 'especie' => 'Cachorro'],
            ['nome' => 'Vira-lata', 'especie' => 'Cachorro'],
            ['nome' => 'Shih Tzu', 'especie' => 'Cachorro'],
            ['nome' => 'Yorkshire Terrier', 'especie' => 'Cachorro'],
        ]);

        // Gatos
        DB::table('racas')->insert([
            ['nome' => 'Siamês', 'especie' => 'Gato'],
            ['nome' => 'Persa', 'especie' => 'Gato'],
            ['nome' => 'Maine Coon', 'especie' => 'Gato'],
            ['nome' => 'SRD', 'especie' => 'Gato'],
            ['nome' => 'Angorá', 'especie' => 'Gato'],
        ]);

        // Pássaros
        DB::table('racas')->insert([
            ['nome' => 'Calopsita', 'especie' => 'Pássaro'],
            ['nome' => 'Periquito Australiano', 'especie' => 'Pássaro'],
            ['nome' => 'Agapornis', 'especie' => 'Pássaro'],
        ]);

        // Roedores
        DB::table('racas')->insert([
            ['nome' => 'Hamster Sírio', 'especie' => 'Roedor'],
            ['nome' => 'Porquinho-da-índia', 'especie' => 'Roedor'],
            ['nome' => 'Chinchila', 'especie' => 'Roedor'],
        ]);

        // Répteis
        DB::table('racas')->insert([
            ['nome' => 'Tartaruga Tigre dÁgua', 'especie' => 'Réptil'],
            ['nome' => 'Iguana', 'especie' => 'Réptil'],
        ]);
    }
}
