<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Items extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id('id');
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('type')->nullable();
            $table->double('base_qty')->nullable();
            $table->integer('uom_id')->nullable();
            $table->integer('unit_box')->nullable();
            $table->double('qty')->nullable();
            $table->double('qty_big')->nullable();
            $table->double('qty_sol')->nullable();
            $table->double('qty_sol_big')->nullable();
            $table->double('qty_bonus')->nullable();
            $table->double('qty_bonus_big')->nullable();
            $table->double('qty_discount')->nullable();
            $table->double('qty_discount_big')->nullable();
            $table->double('qty_deposit')->nullable();
            $table->double('qty_deposit_big')->nullable();
            $table->double('base_price')->nullable();
            $table->double('top_price')->nullable();
            $table->double('bottom_price')->nullable();
            $table->integer('partner_id')->nullable();
            $table->integer('price_status')->nullable();
            $table->double('buy_price')->nullable();
            $table->double('buy_price_pcs')->nullable();
            $table->double('vat')->nullable();
            $table->double('status')->nullable();
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
        Schema::dropIfExists('items');
    }
}
