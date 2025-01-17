<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'telefone',
        'nivel',
        'foto',
        'setor_id',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id'); // A chave estrangeira deve corresponder ao nome na tabela tasks
    }

    public function tarefas_gerais()
    {
        return $this->hasMany(TarefaGeral::class, 'lider_projeto_id');
    }

    public function setor()
    {
        return $this->belongsTo(Setor::class,'setor_id');
    }


    // public function setor()
    // {
    //     return $this->hasMany(Setor::class);
    // }

 

    public function secretaria()
    {
        return $this->hasOne(Secretaria::class);
    }
}
