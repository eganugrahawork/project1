<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('group_id')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('religion')->nullable();
            $table->string('address')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('token')->nullable();
            $table->string('email')->unique();
            $table->integer('email_status')->nullable();
            $table->string('email_code')->nullable();
            $table->string('username')->unique();
            $table->integer('id_detail_user')->unique();
            $table->integer('id_role');
            $table->string('password');
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
