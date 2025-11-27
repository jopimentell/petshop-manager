<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'produtos';

    protected $fillable = [
        'nome', 'descricao', 'preco_custo', 'preco_venda', 
        'quantidade_estoque', 'estoque_minimo', 'ativo', 
        'categoria_id', 'fornecedor_id'
    ];

    protected $casts = [
        'preco_custo' => 'decimal:2',
        'preco_venda' => 'decimal:2',
        'ativo' => 'boolean',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function itensVenda()
    {
        return $this->hasMany(ItemVenda::class);
    }
}