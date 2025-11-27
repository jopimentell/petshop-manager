<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    protected $table = 'funcionarios';
    protected $fillable = [
        'nome', 'cpf', 'telefone', 'cargo_id', 'user_id', 'ativo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class, 'user_id', 'user_id');
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class, 'user_id', 'user_id');
    }
}