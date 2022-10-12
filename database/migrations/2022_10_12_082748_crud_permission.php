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
            $table->integer('id_menu');
            $table->integer('id_submenu');
            $table->integer('created');
            $table->integer('edit');
            $table->integer('deleted');
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
