<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('mysql_2')->hasTable('audios')) {
            Schema::connection('mysql_2')->create('audios', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('link')->unique();
                $table->text('introduce');
                $table->text('transcript')->nullable();
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_2')->dropIfExists('audios');
    }
}
