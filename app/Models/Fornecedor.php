<?php
// app/Models/Fornecedor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    // ✅ ESPECIFICAR O NOME DA TABELA
    protected $table = 'fornecedores';

    protected $fillable = [
        'razao_social', 
        'nome_fantasia', 
        'cnpj', 
        'email', 
        'telefone', 
        'endereco',
        'ativo'
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'fornecedor_id');
    }
}