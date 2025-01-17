<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tarefas_gerais', function (Blueprint $table) {
            $table->id();
            $table->string('nome_projeto');
            $table->text('descricao_projeto');
            $table->date('data_inicio');
            $table->date('data_final');
            $table->enum('status',['CONCLUIDO', 'EM ANDAMENTO'])->nullable();
            $table->BigInteger('lider_projeto_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
       

        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('tarefas_gerais');
    }
};
