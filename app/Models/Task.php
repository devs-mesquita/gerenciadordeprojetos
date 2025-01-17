<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'projeto_id',
        'nome_task',
        'descricao_task',
        'status_task',
        'prazo',
        'data_criacao',
    ];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class, 'projeto_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_responsavel'); // A chave estrangeira deve corresponder ao nome na tabela tasks
    }
}
