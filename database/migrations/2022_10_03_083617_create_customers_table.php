<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('cust_code');
            $table->string('cust_name');
            $table->integer('region');
            $table->string('no_npwp');
            $table->string('npwp_address');
            $table->string('cust_address');
            $table->string('district');
            $table->string('city');
            $table->string('group');
            $table->string('phone');
            $table->string('email');
            $table->string('contact_person')->nullable();
            $table->double('credit_limit')->nullable();
            $table->integer('credit_status')->nullable();
            $table->double('credit_left')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
