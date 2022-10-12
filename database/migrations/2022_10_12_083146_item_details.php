<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_details', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->integer('purchase_order_detail_receive_id');
            $table->integer('qty');
            $table->integer('qty_big');
            // $table->timestamps('date_insert');
            $table->double('buy_price');
            $table->double('qty_sol');
            $table->double('qty_sol_big');
            $table->double('qty_bonus_big');
            $table->double('qty_bonus');
            $table->double('qty_deposit');
            $table->double('qty_deposit_big');
            $table->double('qty_discount');
            $table->double('qty_discount_big');
            $table->boolean('status');
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
        Schema::dropIfExists('item_details');
    }
}
