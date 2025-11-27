<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;
    protected $table = 'agendamentos';
    protected $fillable = [
        'data_hora', 'situacao', 'observacoes', 'valor_total', 'animal_id', 'user_id'
    ];

    protected $casts = [
        'data_hora' => 'datetime',
        'valor_total' => 'decimal:2',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'agendamento_servico')
                    ->withPivot('preco', 'observacoes')
                    ->withTimestamps();
    }
}