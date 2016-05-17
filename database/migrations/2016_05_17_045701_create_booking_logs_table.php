<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('period_id')->unsigned();
            $table->integer('menu_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('number');
            $table->integer('price');
            $table->enum('status', ['not_confirmed', 'confirmed']);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('period_id')->references('id')->on('periods')->onUpdate('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('booking_logs');
    }
}
