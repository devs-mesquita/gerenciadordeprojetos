<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;
    protected $table = "setor";
    protected $fillable = [ 
        'nome_setor',
        'secretaria_id'
    ];


    public function user()
    {
        return $this->hasMany(User::class);
    }

   

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class, 'secretaria_id');
    }

    
    public function tarefas_gerais()
    {
        return $this->belongsTo(TarefasGerais::class);
    }
    
}
