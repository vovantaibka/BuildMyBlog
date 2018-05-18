<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoUserToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birth_day')->nullable()->after('name');
            $table->string('gender')->nullable()->after('birth_day');
            $table->string('address')->nullable()->after('gender');
            $table->string('phone')->nullable()->after('address');
            $table->string('image')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['birth_day', 'gender', 'address', 'phone', 'image']);
        });
    }
}
