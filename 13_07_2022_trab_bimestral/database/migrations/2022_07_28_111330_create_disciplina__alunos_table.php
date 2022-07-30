<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplina__alunos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('disciplina_id');
            $table->unsignedBigInteger('aluno_id');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disciplina__alunos');
    }
};
