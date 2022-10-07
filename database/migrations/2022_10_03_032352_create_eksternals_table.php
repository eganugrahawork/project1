<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEksternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eksternals', function (Blueprint $table) {
            $table->id();
            $table->string('kode_eksternal')->nullable();
            $table->string('name_eksternal')->nullable();
            $table->string('lot_number')->nullable();
            $table->string('eksternal_address')->nullable();
            $table->string('ship_address')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('pic')->nullable();
            $table->integer('eksternal_loc')->nullable();
            $table->integer('type_eksternal')->nullable();
            $table->string('bank1')->nullable();
            $table->string('rek1')->nullable();
            $table->string('bank2')->nullable();
            $table->string('rek2')->nullable();
            $table->string('bank3')->nullable();
            $table->string('rek3')->nullable();
            $table->integer('sts_show')->nullable();
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
        Schema::dropIfExists('eksternals');
    }
}
