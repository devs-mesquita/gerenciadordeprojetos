<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarefasGerais extends Model
{
    protected $table = "tarefas_gerais";
    use HasFactory;
    protected $fillable = [ 
        'nome_projeto',
        'descricao_projeto',
        'data_inicio',
        'data_final', 
        'status',
        'lider_projeto_id',
        'setor_id'
    ];
      
      protected $casts = [
        'data_inicio' => 'datetime',
        'data_final' => 'datetime',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id'); // A chave estrangeira deve corresponder ao nome na tabela tasks
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'lider_projeto_id', 'id');
    }

    public function setor()
    {
        return $this->hasMany(Setor::class,'setor_id');
    }

    public function secretaria()
    {
        return $this->hasOne(Secretaria::class);
    }
}
