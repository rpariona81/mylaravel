<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu', 45)->nullable();
            $table->string('controller', 45)->nullable();
            $table->string('action', 45)->nullable();
            $table->string('url', 100)->nullable();
            $table->integer('order')->nullable();
            $table->boolean('visible')->nullable();
            $table->boolean('is_active')->nullable();
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
        Schema::dropIfExists('t_menus');
    }
};
