<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlatPromoServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flat_promo_service', function (Blueprint $table) {
            $table->unsignedBigInteger('flat_id');
            $table->foreign('flat_id')->references('id')->on('flats')->onDelete('cascade');

            $table->unsignedBigInteger('promo_service_id');
            $table->foreign('promo_service_id')->references('id')->on('promo_services')->onDelete('cascade');

            $table->timestamp('created_at');
            $table->dateTime('end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flat_promo_service');
    }
}
