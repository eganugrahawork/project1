<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrudPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crud_permission', function (Blueprint $table) {
            $table->id();
            $table->integer('id_role');
            $table->integer('id_menu')->default('0');
            $table->integer('id_submenu')->default('0');
            $table->integer('created')->default('0');
            $table->integer('edit')->default('0');
            $table->integer('deleted')->default('0');
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
        Schema::dropIfExists('crud_permission');
    }
}
