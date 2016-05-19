<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creation_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('timestamp');
            $table->enum('type', ['meal', 'dorm', 'attendance', 'weekend_attendance', 'parking']);
            $table->enum('status', ['locked', 'unlocked'])->default('locked');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('creation_logs');
    }
}
