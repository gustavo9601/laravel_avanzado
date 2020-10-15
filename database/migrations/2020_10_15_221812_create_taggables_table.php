<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaggablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taggables', function (Blueprint $table) {
            $table->id();

            $table->integer('tag_id')->unsigned(); // id del tag en la tabla tags
            $table->integer('taggable_id')->unsigned(); // id del modelo
            $table->string('taggable_type');  // Modelo App\Message || App\User
            // $table->morphs('taggable'); // hace lo mismo que las 3 columnas de arriba

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
        Schema::dropIfExists('taggables');
    }
}
