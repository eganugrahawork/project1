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
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('religion')->nullable();
            $table->string('address')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->unique();
            $table->string('token')->nullable();
            $table->integer('email_status')->nullable();
            $table->string('email_code')->nullable();
            $table->integer('sms_status')->unique();
            $table->string('sms_code')->unique();
            $table->integer('id_role');
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
