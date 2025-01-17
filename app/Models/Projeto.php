<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_lider',
        'nome_projeto',
        'descricao_projeto',
        'data_inicio',
        'data-final', // Se necessário
        'setor',
        'repositorio',
        'criacao_projeto',
    ];


    public function user()
    {
        return $this->belongsTo(User::class); // Ajuste conforme o relacionamento
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'projeto_id'); // Chave estrangeira
    }
}
