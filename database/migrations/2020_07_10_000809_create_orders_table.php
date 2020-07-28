<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->unsignedBigInteger('schedule_date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('foodmenu_id');
            $table->unsignedBigInteger('topup_id');
            
            $table->foreign('foodmenu_id')->references('id')->on('food_menus');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('schedule_date')->references('id')->on('schedules');
            $table->foreign('topup_id')->references('id')->on('top_ups');
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
        Schema::dropIfExists('orders');
    }
}
