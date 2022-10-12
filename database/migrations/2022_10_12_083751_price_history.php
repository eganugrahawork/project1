<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PriceHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_history', function (Blueprint $table) {
            $table->id();
            $table->integer('items_id');
            $table->double('top_price');
            $table->double('bottom_price');
            $table->double('harga_good_sold');
            $table->timestamps('aproval_date');
            $table->timestamps('aproval_at');
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
        Schema::dropIfExists('price_history');
    }
}
