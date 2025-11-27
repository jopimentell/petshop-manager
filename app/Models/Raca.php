<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raca extends Model
{
    use HasFactory;
    protected $table = 'racas';
    protected $fillable = ['nome', 'especie', 'descricao'];

    public function animais()
    {
        return $this->hasMany(Animal::class);
    }
}