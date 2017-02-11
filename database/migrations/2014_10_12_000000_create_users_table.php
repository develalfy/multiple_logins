<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('surname');
            $table->string('gender');
            $table->boolean('orchestra')->default(false);
            $table->boolean('musician')->default(false);
            $table->boolean('member')->default(false);
            $table->string('orchestra_name')->default('');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('confirmation')->default('');
            $table->boolean('confirmed')->default(false);
            $table->enum('current_role', [0, 1, 2]);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
