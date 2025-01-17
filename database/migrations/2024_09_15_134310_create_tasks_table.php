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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projeto_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('nome_task')->nullable();
            $table->text('descricao_task')->nullable();
            $table->enum('status_task', ['TAREFAS', 'FAZENDO', 'ANALISE', 'FINALIZADO'])->nullable();
            $table->unsignedBigInteger('user_responsavel')->nullable();
            $table->date('prazo')->nullable();
            $table->timestamps();

            // Definir a chave estrangeira para user_responsavel
            $table->foreign('user_responsavel')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
