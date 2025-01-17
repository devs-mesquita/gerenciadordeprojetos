<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    use HasFactory;
    protected $table = "secretaria";
    protected $fillable = [ 
        'nome_secretaria'
       
    ];

    public function user(): BelongsTod
    {
        return $this->belongsTo(User::class);
    }


    public function setor()
    {
        return $this->hasMany(Setor::class, 'secretaria_id');
    }
   

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class);
    }


    
}
