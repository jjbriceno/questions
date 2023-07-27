<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->comment('Referencia a la categoria a la que pertenece la pregunta')
            ->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->longText('question_name')->comment('Nombre de la pregunta');
            $table->json('answers_options')->comment('Opciones para responder la pregunta');
            $table->string('answer')->comment('Respuesta correcta a la pregunta');
            $table->text('unit')->comment('Unidad de medida de la respuesta');
            
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
        Schema::dropIfExists('questions');
    }
}
