<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypeItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_items', function (Blueprint $table) {
            $table->id('id_type_item');
            $table->string('type_item_name');
            $table->string('type_item_description')->nullable();
            $table->integer('vat')->nullable();
            $table->integer('status')->nullable();
            $table->integer('id_coa');
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
        Schema::dropIfExists('type_items');
    }
}
