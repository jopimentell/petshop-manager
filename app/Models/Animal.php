<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animais';

    protected $fillable = [
        'nome', 'data_nascimento', 'sexo', 'cor', 'observacoes', 'dono_id', 'raca_id'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function dono()
    {
        return $this->belongsTo(Cliente::class, 'dono_id');
    }

    public function raca()
    {
        return $this->belongsTo(Raca::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}