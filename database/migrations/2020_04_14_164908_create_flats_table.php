<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->integer('rooms');
            $table->integer('mq');
            $table->string('cover');
            $table->string('guest')->nullable();
            $table->text('description');
            $table->integer('price_day');
            $table->integer('beds');
            $table->integer('bathrooms');
            $table->double('lat', 7, 5);
            $table->double('long', 8, 5);
            $table->string('slug');
            $table->boolean('hidden');
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
        Schema::dropIfExists('flats');
    }
}
