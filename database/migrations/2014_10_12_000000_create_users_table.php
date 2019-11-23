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
        Schema::create('user_table', function (Blueprint $table) {
            $table->increments('_id');
            $table->string('facebook_id')->nullable();
            $table->string('name')->nullable(false);
            $table->string('lastname');
            $table->string('useremail')->unique();
            $table->string('password')->default(false)->nullable(false);
            $table->string('dob',10)->nullable();
            $table->string('gender',50)->nullable();
            $table->string('country_code')->default(NULL)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('email',50)->nullable();
        });

        // Schema::create('users', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->string('password');
        //     $table->rememberToken();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_table');
    }
}
