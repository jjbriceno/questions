<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->comment('Referencia a la categoria a la que pertenece la pregunta')
            ->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('question_id')->comment('Referencia a la pregunta del cuestionario')
            ->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->comment('Referencia al usuario que responde el cuestionario')
            ->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->string('user_answer');
            $table->string('correct_answer');
            $table->boolean('output');
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
        Schema::dropIfExists('data_sets');
    }
}
