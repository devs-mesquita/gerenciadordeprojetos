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
        Schema::table('tarefas_gerais', function (Blueprint $table) {
            $table->BigInteger('setor_id')->unsigned();
            $table->foreign('setor_id')->references('id')->on('setor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tarefas_gerais', function (Blueprint $table) {
            //
        });
    }
};
