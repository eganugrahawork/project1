<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id('id_mat');
            $table->string('stock_code')->nullable();
            $table->string('stock_name')->nullable();
            $table->string('stock_desc')->nullable();
            $table->integer('type')->nullable();
            $table->double('base_qty')->nullable();
            $table->integer('unit_terkecil')->nullable();
            $table->integer('unit_box')->nullable();
            $table->double('qty')->nullable();
            $table->double('qty_big')->nullable();
            $table->double('qty_sol')->nullable();
            $table->double('qty_sol_big')->nullable();
            $table->double('qty_sol_bonus')->nullable();
            $table->double('qty_sol_bonus_big')->nullable();
            $table->double('qty_titip')->nullable();
            $table->double('qty_titip_big')->nullable();
            $table->integer('status')->nullable();
            $table->double('base_price')->nullable();
            $table->double('top_price')->nullable();
            $table->double('bottom_price')->nullable();
            $table->integer('dist_id')->nullable();
            $table->double('daily_stock')->nullable();
            $table->integer('status_harga')->nullable();
            $table->double('buy_price')->nullable();
            $table->double('buy_price_pcs')->nullable();
            $table->double('pajak')->nullable();
            $table->double('qty_diskon')->nullable();
            $table->double('qty_diskon_big')->nullable();
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
        Schema::dropIfExists('materials');
    }
}
