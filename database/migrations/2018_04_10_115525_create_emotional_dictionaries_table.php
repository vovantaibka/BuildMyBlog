<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmotionalDictionariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('emotional_dictionaries')->create('emotional_dictionaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('english')->nullable();
            $table->string('vietnamese')->charset('utf8');
            $table->tinyInteger('positive')->nullable();
            $table->tinyInteger('negative')->nullable();
            $table->tinyInteger('anger')->nullable();
            $table->tinyInteger('anticipation')->nullable();
            $table->tinyInteger('disgust')->nullable();
            $table->tinyInteger('fear')->nullable();
            $table->tinyInteger('joy')->nullable();
            $table->tinyInteger('sadness')->nullable();
            $table->tinyInteger('surprise')->nullable();
            $table->tinyInteger('trust')->nullable();
            $table->tinyInteger('total')->nullable();
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
        Schema::connection('emotional_dictionaries')->dropIfExists('emotional_dictionaries');
    }
}
