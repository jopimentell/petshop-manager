<?php
// app/Models/AgendamentoServico.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendamentoServico extends Model
{
    use HasFactory;

    protected $table = 'agendamento_servico';

    protected $fillable = [
        'agendamento_id', 'servico_id', 'preco', 'observacoes'
    ];

    protected $casts = [
        'preco' => 'decimal:2',
    ];

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class, 'agendamento_id');
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class, 'servico_id');
    }
}