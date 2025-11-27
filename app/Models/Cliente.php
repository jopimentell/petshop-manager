<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';

    protected $fillable = [
        'nome', 'cpf', 'telefone', 'email', 'endereco'
    ];

    public function animais()
    {
        return $this->hasMany(Animal::class, 'dono_id');
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}