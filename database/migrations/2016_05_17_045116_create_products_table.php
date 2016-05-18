<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->string('name');
            $table->string('unit_type');
            $table->integer('inventory');
            $table->integer('order_qty')->default(0);
            $table->integer('price');
            $table->mediumText('description');

            $table->timestamps();
            $table->softDeletes(); // This system will not provide the funtion of deletion for Products.

            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
